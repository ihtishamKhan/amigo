<?php
// config/printer.php

return [
    /*
    |--------------------------------------------------------------------------
    | Printer Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the receipt printer
    |
    */

    // Preview mode (set to false in production)
    'preview_mode' => env('PRINTER_PREVIEW_MODE', true),

    // Printer connection path
    'path' => env('PRINTER_PATH', '/dev/usb/lp0'),

    // Paper settings (in mm)
    'paper_width' => 80,
    'paper_height' => 297, // A4 length, adjust as needed

    // Font settings
    'font_size' => 12,
    'font_family' => 'Courier New',

    // Margins (in mm)
    'margin_top' => 5,
    'margin_bottom' => 5,
    'margin_left' => 5,
    'margin_right' => 5,
];