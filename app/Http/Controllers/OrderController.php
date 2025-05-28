<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\ReceiptPrinterService;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    protected $printerService;
    
    public function __construct(ReceiptPrinterService $printerService)
    {
        $this->printerService = $printerService;
    }
    
    public function index()
    {
        $orders = Order::with(['orderItems.orderable', 'user'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function current()
    {
        $orders = Order::with(['orderItems.orderable', 'user'])
            ->where('status', 'in-progress')
            ->latest()
            ->get();

        return view('admin.orders.current', compact('orders'));
    }

    public function show($uuid)
    {
        $order = Order::with([
            'orderItems.orderable',
            'orderItems.productVariation',
            'orderItems.orderItemOptions.optionGroup',
            'orderItems.orderItemAddons.addonCategory',
            'orderItems.mealDealItems.section',
            'user'
        ])->where('uuid', $uuid)->first();

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            
            // Validate the status
            $request->validate([
                'status' => 'required|in:created,in-progress,completed',
            ]);
            
            // Update the order status
            $order->status = $request->status;
            $order->save();
            
            return redirect()->back()->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }

    public function cancelOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            
            // Update the order status to cancelled
            $order->status = 'cancelled';
            $order->save();
            
            // Optional: You may want to perform additional actions here
            // such as refunding payment, updating inventory, etc.
            
            return redirect()->back()->with('success', 'Order has been cancelled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel order: ' . $e->getMessage());
        }
    }

    public function printReceipt()
    {
        $orderData = [
            'order_number' => 'ORD-' . rand(1000, 9999),
            'items' => [
                [
                    'name' => 'Burger',
                    'quantity' => 2,
                    'price' => 9.99
                ],
                [
                    'name' => 'Fries',
                    'quantity' => 1,
                    'price' => 3.99
                ]
            ],
            'total' => 23.97
        ];

        // For browser preview
        if (request()->has('preview')) {
            return view('admin.orders.thermal-print', [
                'order' => $orderData,
                'isPreview' => true
            ]);
        }

        // For PDF generation
        $pdf = PDF::loadView('admin.orders.thermal-print', [
            'order' => $orderData
        ]);

        // Adjust paper size for thermal receipt
        // Width: 80mm ≈ 226.77px
        // Height: Auto-height based on content (let's set a reasonable max)
        $customPaper = array(0, 0, 226.77, 1000); // Increased height to 1000px
        $pdf->setPaper($customPaper, 'portrait');
        
        // Optional: Set other PDF options
        $pdf->setOptions([
            'dpi' => 203, // Common thermal printer DPI
            'defaultFont' => 'courier',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->stream('receipt.pdf');
    }
    
    public function printTest()
    {
        // Sample order data for testing
        $orderData = [
            'order_number' => 'ORD-' . rand(1000, 9999),
            'items' => [
                [
                    'name' => 'Burger',
                    'quantity' => 2,
                    'price' => 9.99
                ],
                [
                    'name' => 'Fries',
                    'quantity' => 1,
                    'price' => 3.99
                ]
            ],
            'total' => 23.97
        ];
        
        return $this->printerService->printReceipt($orderData);
    } 

    public function print($id)
    {
        $order = Order::with(['orderItems', 'user'])->find($id);

        return view('admin.orders.print', compact('order'));
    }
}
