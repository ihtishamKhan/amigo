<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class ReceiptPrinterService
{
    protected $printerPath;
    protected $isPrintPreview;
    
    public function __construct()
    {
        $this->printerPath = config('printer.path');
        $this->isPrintPreview = config('printer.preview_mode', true);
    }
    
    /**
     * Print or preview the receipt based on environment
     */
    public function printReceipt($orderData)
    {
        if ($this->isPrintPreview) {
            return $this->generatePreview($orderData);
        }
        
        return $this->printToThermalPrinter($orderData);
    }
    
    /**
     * Generate a preview PDF for testing
     */
    protected function generatePreview($orderData)
    {
        $html = view('admin.orders.thermal-print', [
            'order' => $orderData,
            'isPreview' => true
        ])->render();

        
        return PDF::loadView($html)
            ->setPaper([0, 0, 226.77, 841.89], 'portrait') // 80mm width
            ->save('receipt-preview.pdf');
    }
    
    /**
     * Print to actual thermal printer
     */
    protected function printToThermalPrinter($orderData)
    {
        try {
            $connector = new FilePrintConnector($this->printerPath);
            $printer = new Printer($connector);
            
            // Set printer mode
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            
            // Print header
            $printer->setEmphasis(true);
            $printer->text("YOUR RESTAURANT NAME\n");
            $printer->setEmphasis(false);
            $printer->text("Address Line 1\n");
            $printer->text("Address Line 2\n");
            $printer->text("Tel: xxx-xxx-xxxx\n");
            $printer->feed();
            
            // Order details
            $printer->text("Order #" . $orderData['order_number'] . "\n");
            $printer->text("Date: " . now()->format('Y-m-d H:i:s') . "\n");
            $printer->feed();
            
            // Items
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            foreach ($orderData['items'] as $item) {
                $printer->text($item['quantity'] . "x " . $item['name'] . "\n");
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text("$" . number_format($item['price'], 2) . "\n");
                $printer->setJustification(Printer::JUSTIFY_LEFT);
            }
            
            $printer->feed();
            
            // Total
            $printer->setEmphasis(true);
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("Total: $" . number_format($orderData['total'], 2) . "\n");
            $printer->setEmphasis(false);
            
            // Footer
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->feed();
            $printer->text("Thank you for your order!\n");
            $printer->feed(2);
            
            $printer->cut();
            $printer->close();
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Printer error: ' . $e->getMessage());
            throw new \Exception('Failed to print receipt: ' . $e->getMessage());
        }
    }
}