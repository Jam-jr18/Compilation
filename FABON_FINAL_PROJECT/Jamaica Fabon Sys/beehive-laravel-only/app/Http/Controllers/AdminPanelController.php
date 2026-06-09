<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantTable;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminPanelController extends Controller
{
    public function dashboard(): View
    {
        $today = now()->startOfDay();
        $week = now()->startOfWeek();
        $month = now()->startOfMonth();
        $year = now()->startOfYear();
        $completed = Order::where('status', 'completed');

        return view('admin.dashboard', [
            'sales' => [
                'today' => (clone $completed)->where('created_at', '>=', $today)->sum('total'),
                'week' => (clone $completed)->where('created_at', '>=', $week)->sum('total'),
                'month' => (clone $completed)->where('created_at', '>=', $month)->sum('total'),
                'year' => (clone $completed)->where('created_at', '>=', $year)->sum('total'),
            ],
            'counts' => [
                'pending' => Order::where('status', 'pending')->count(),
                'preparing' => Order::where('status', 'preparing')->count(),
                'ready' => Order::where('status', 'ready')->count(),
                'completed_today' => Order::where('status', 'completed')->whereDate('created_at', now()->toDateString())->count(),
                'total_volume' => Order::where('status', 'completed')->count(),
            ],
            'tables' => [
                'available' => RestaurantTable::where('status', 'available')->count(),
                'occupied' => RestaurantTable::where('status', 'occupied')->count(),
                'reserved' => RestaurantTable::where('status', 'reserved')->count(),
                'total' => RestaurantTable::count(),
            ],
            'categorySales' => OrderItem::query()
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->leftJoin('menu_items', 'menu_items.id', '=', 'order_items.menu_item_id')
                ->leftJoin('menu_categories', 'menu_categories.id', '=', 'menu_items.menu_category_id')
                ->where('orders.status', 'completed')
                ->selectRaw('COALESCE(menu_categories.name, "Uncategorized") as category, SUM(order_items.line_total) as total')
                ->groupBy('category')
                ->orderByDesc('total')
                ->get(),
            'topItems' => OrderItem::query()
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->where('orders.status', 'completed')
                ->selectRaw('order_items.item_name, SUM(order_items.quantity) as quantity, SUM(order_items.line_total) as total')
                ->groupBy('order_items.item_name')
                ->orderByDesc('quantity')
                ->limit(10)
                ->get(),
            'recentOrders' => Order::with(['items', 'table'])->latest()->limit(10)->get(),
        ]);
    }

    public function menu(): View
    {
        return view('admin.menu', [
            'categories' => MenuCategory::with('items')->orderBy('sort_order')->orderBy('name')->get(),
            'items' => MenuItem::with('category')->latest()->get(),
        ]);
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:menu_categories,name'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        MenuCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with('success', 'Category added.');
    }

    public function updateCategory(Request $request, MenuCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', Rule::unique('menu_categories', 'name')->ignore($category)],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'sort_order' => $validated['sort_order'] ?? $category->sort_order,
        ]);

        return back()->with('success', 'Category updated.');
    }

    public function deleteCategory(MenuCategory $category): RedirectResponse
    {
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }

    public function storeItem(Request $request): RedirectResponse
    {
        $validated = $this->validateItem($request);
        unset($validated['image_file']);
        $validated['image_base64'] = $this->imageToBase64($request) ?? $validated['image_base64'] ?? null;
        $validated['is_available'] = $request->boolean('is_available');

        MenuItem::create($validated);

        return back()->with('success', 'Menu item added.');
    }

    public function updateItem(Request $request, MenuItem $item): RedirectResponse
    {
        $validated = $this->validateItem($request, true);
        unset($validated['image_file']);
        $uploadedImage = $this->imageToBase64($request);
        $validated['image_base64'] = $uploadedImage ?? $item->image_base64;
        $validated['is_available'] = $request->boolean('is_available');

        $item->update($validated);

        return back()->with('success', 'Menu item updated.');
    }

    public function deleteItem(MenuItem $item): RedirectResponse
    {
        $item->delete();
        return back()->with('success', 'Menu item deleted.');
    }

    public function tables(): View
    {
        return view('admin.tables', [
            'tables' => RestaurantTable::orderBy('name')->get(),
        ]);
    }

    public function storeTable(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:restaurant_tables,name'],
            'capacity' => ['required', 'integer', 'min:1', 'max:30'],
        ]);

        RestaurantTable::create($validated + ['status' => 'available']);

        return back()->with('success', 'Table added.');
    }

    public function updateTable(Request $request, RestaurantTable $table): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('restaurant_tables', 'name')->ignore($table)],
            'capacity' => ['required', 'integer', 'min:1', 'max:30'],
            'status' => ['required', Rule::in(['available', 'occupied', 'reserved'])],
        ]);

        $table->update($validated);

        return back()->with('success', 'Table updated.');
    }

    public function deleteTable(RestaurantTable $table): RedirectResponse
    {
        $table->delete();
        return back()->with('success', 'Table deleted.');
    }

    public function settings(): View
    {
        return view('admin.settings', [
            'settings' => $this->publicSettings(),
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'business_name' => ['nullable', 'string', 'max:120'],
            'business_tagline' => ['nullable', 'string', 'max:160'],
            'gcash_name' => ['nullable', 'string', 'max:120'],
            'gcash_number' => ['nullable', 'string', 'max:30'],
            'staff_pin' => ['nullable', 'string', 'min:4', 'max:64'],
            'admin_pin' => ['nullable', 'string', 'min:4', 'max:64'],
            'gcash_qr_image' => ['nullable', 'image', 'max:2048'],
        ]);

        foreach (['business_name', 'business_tagline', 'gcash_name', 'gcash_number'] as $key) {
            Setting::put($key, $validated[$key] ?? '');
        }

        if ($request->hasFile('gcash_qr_image')) {
            Setting::put('gcash_qr_base64', $this->imageToBase64($request, 'gcash_qr_image'));
        }

        if (! empty($validated['staff_pin'])) {
            Setting::put('staff_pin_hash', Hash::make($validated['staff_pin']));
        }

        if (! empty($validated['admin_pin'])) {
            Setting::put('admin_pin_hash', Hash::make($validated['admin_pin']));
        }

        return back()->with('success', 'Settings updated.');
    }

    public function exportSales(Request $request)
    {
        $period = $request->query('period', 'today');
        $query = Order::with(['items', 'table'])->where('status', 'completed');

        if ($period === 'today') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($period === 'month') {
            $query->where('created_at', '>=', now()->startOfMonth());
        } elseif ($period === 'year') {
            $query->where('created_at', '>=', now()->startOfYear());
        }

        $orders = $query->latest()->get();
        $filename = 'beehive-sales-'.$period.'-'.now()->format('Ymd-His').'.csv';

        $callback = function () use ($orders) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Order No.', 'Date', 'Type', 'Table', 'Customer', 'Payment', 'Status', 'Items', 'Total']);

            foreach ($orders as $order) {
                fputcsv($out, [
                    $order->order_number,
                    $order->created_at->format('Y-m-d H:i:s'),
                    str_replace('_', ' ', $order->order_type),
                    $order->table?->name,
                    $order->customer_name,
                    $order->payment_method.' / '.$order->payment_status,
                    $order->status,
                    $order->items->map(fn ($item) => $item->item_name.' x'.$item->quantity)->join('; '),
                    $order->total,
                ]);
            }

            fclose($out);
        };

        return Response::streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    private function validateItem(Request $request): array
    {
        return $request->validate([
            'menu_category_id' => ['required', 'integer', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
            'price' => ['required', 'numeric', 'min:1', 'max:999999'],
            'image_base64' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function imageToBase64(Request $request, string $field = 'image_file'): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        return 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
    }

    private function publicSettings(): array
    {
        return [
            'business_name' => Setting::valueFor('business_name', 'BeeHive Restobar'),
            'business_tagline' => Setting::valueFor('business_tagline', 'sweet bites, hot plates, happy nights'),
            'gcash_name' => Setting::valueFor('gcash_name', 'BeeHive Restobar'),
            'gcash_number' => Setting::valueFor('gcash_number', '09XX XXX XXXX'),
            'gcash_qr_base64' => Setting::valueFor('gcash_qr_base64'),
        ];
    }
}
