<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StaffPanelController extends Controller
{
    public function index(): View
    {
        return view('staff.orders', [
            'orders' => Order::with(['items', 'table'])
                ->whereDate('created_at', now()->toDateString())
                ->whereIn('status', ['pending', 'preparing', 'ready'])
                ->latest()
                ->get(),
            'completedToday' => Order::with(['items', 'table'])
                ->whereDate('created_at', now()->toDateString())
                ->where('status', 'completed')
                ->latest()
                ->limit(10)
                ->get(),
        ]);
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'preparing', 'ready', 'completed', 'cancelled'])],
        ]);

        $order->update(['status' => $validated['status']]);

        if (in_array($validated['status'], ['completed', 'cancelled'], true) && $order->restaurant_table_id) {
            $order->table?->update(['status' => 'available']);
        }

        if ($order->payment_method === 'cash' && $validated['status'] === 'completed') {
            $order->update(['payment_status' => 'paid']);
        }

        return back()->with('success', 'Order '.$order->order_number.' updated.');
    }
}
