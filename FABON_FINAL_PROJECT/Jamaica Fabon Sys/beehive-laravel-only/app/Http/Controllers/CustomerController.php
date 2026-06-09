<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RestaurantTable;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customer.index', [
            'business' => $this->business(),
            'categories' => MenuCategory::with(['items' => function ($query) {
                $query->where('is_available', true)->orderBy('name');
            }])->orderBy('sort_order')->orderBy('name')->get(),
            'tables' => RestaurantTable::where('status', 'available')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_type' => ['required', Rule::in(['dine_in', 'take_out'])],
            'restaurant_table_id' => ['nullable', 'integer', 'exists:restaurant_tables,id'],
            'customer_name' => ['nullable', 'string', 'max:120'],
            'payment_method' => ['required', Rule::in(['cash', 'ewallet'])],
            'payment_sender_name' => ['nullable', 'string', 'max:120'],
            'payment_reference' => ['nullable', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:500'],
            'quantities' => ['required', 'array'],
            'quantities.*' => ['nullable', 'integer', 'min:0', 'max:99'],
        ]);

        $items = collect($validated['quantities'])
            ->map(fn ($quantity) => (int) $quantity)
            ->filter(fn ($quantity) => $quantity > 0);

        if ($items->isEmpty()) {
            return back()->withInput()->with('error', 'Please choose at least one menu item.');
        }

        if ($validated['order_type'] === 'dine_in' && empty($validated['restaurant_table_id'])) {
            return back()->withInput()->with('error', 'Please select an available table for dine-in orders.');
        }

        if ($validated['payment_method'] === 'ewallet' && (empty($validated['payment_sender_name']) || empty($validated['payment_reference']))) {
            return back()->withInput()->with('error', 'Sender name and reference number are required for e-wallet payments.');
        }

        try {
            $order = DB::transaction(function () use ($validated, $items) {
                $table = null;

                if ($validated['order_type'] === 'dine_in') {
                    $table = RestaurantTable::lockForUpdate()->findOrFail($validated['restaurant_table_id']);

                    if ($table->status !== 'available') {
                        throw new \RuntimeException('Selected table is no longer available.');
                    }
                }

                $menuItems = MenuItem::whereIn('id', $items->keys())
                    ->where('is_available', true)
                    ->get()
                    ->keyBy('id');

                $subtotal = 0;
                $lineItems = [];

                foreach ($items as $menuItemId => $quantity) {
                    $menuItem = $menuItems->get((int) $menuItemId);

                    if (! $menuItem) {
                        throw new \RuntimeException('A selected menu item is unavailable.');
                    }

                    $lineTotal = (float) $menuItem->price * $quantity;
                    $subtotal += $lineTotal;

                    $lineItems[] = [
                        'menu_item_id' => $menuItem->id,
                        'item_name' => $menuItem->name,
                        'unit_price' => $menuItem->price,
                        'quantity' => $quantity,
                        'line_total' => $lineTotal,
                    ];
                }

                $order = Order::create([
                    'order_number' => $this->makeOrderNumber(),
                    'order_type' => $validated['order_type'],
                    'restaurant_table_id' => $table?->id,
                    'customer_name' => $validated['customer_name'] ?? null,
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => $validated['payment_method'] === 'cash' ? 'unpaid' : 'paid',
                    'payment_sender_name' => $validated['payment_sender_name'] ?? null,
                    'payment_reference' => $validated['payment_reference'] ?? null,
                    'status' => 'pending',
                    'subtotal' => $subtotal,
                    'total' => $subtotal,
                    'notes' => $validated['notes'] ?? null,
                ]);

                foreach ($lineItems as $lineItem) {
                    $order->items()->create($lineItem);
                }

                if ($table) {
                    $table->update(['status' => 'occupied']);
                }

                return $order->load(['items', 'table']);
            });
        } catch (\Throwable $exception) {
            return back()->withInput()->with('error', $exception->getMessage());
        }

        return redirect()->route('orders.receipt', $order)->with('success', 'Order received by the hive.');
    }

    public function receipt(Order $order): View
    {
        return view('customer.receipt', [
            'business' => $this->business(),
            'order' => $order->load(['items', 'table']),
        ]);
    }

    public function trackForm(): View
    {
        return view('customer.track', [
            'business' => $this->business(),
            'order' => null,
        ]);
    }

    public function trackRedirect(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_number' => ['required', 'string', 'max:60'],
        ]);

        return redirect()->route('orders.track', ['order' => strtoupper(trim($validated['order_number']))]);
    }

    public function track(Order $order): View
    {
        return view('customer.track', [
            'business' => $this->business(),
            'order' => $order->load(['items', 'table']),
        ]);
    }

    private function business(): array
    {
        return [
            'name' => Setting::valueFor('business_name', 'BeeHive Restobar'),
            'tagline' => Setting::valueFor('business_tagline', 'sweet bites, hot plates, happy nights'),
            'gcash_qr_base64' => Setting::valueFor('gcash_qr_base64'),
            'gcash_name' => Setting::valueFor('gcash_name', 'BeeHive Restobar'),
            'gcash_number' => Setting::valueFor('gcash_number', '09XX XXX XXXX'),
        ];
    }

    private function makeOrderNumber(): string
    {
        do {
            $number = 'BEE-'.now()->format('ymd').'-'.strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
