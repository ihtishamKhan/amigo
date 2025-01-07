<!-- resources/views/receipts/thermal.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <style>
        /* Reset defaults */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Receipt styles */
        body {
            font-family: 'Courier New', monospace;
            font-size: 10px;
            /* Slightly smaller font */
            width: 76mm;
            /* Slightly less than 80mm to account for margins */
            padding: 2mm;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 5mm;
        }

        .header h1 {
            font-size: 12px;
            margin-bottom: 2mm;
        }

        .header p {
            margin: 1mm 0;
            line-height: 1.2;
        }

        .order-info {
            margin: 3mm 0;
            padding: 2mm 0;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .items {
            margin: 3mm 0;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin: 1mm 0;
            clear: both;
            line-height: 1.2;
        }

        .item span {
            display: inline-block;
        }

        .item span:first-child {
            width: 70%;
            text-align: left;
        }

        .item span:last-child {
            width: 30%;
            text-align: right;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin: 3mm 0;
            padding-top: 2mm;
            border-top: 1px dashed #000;
        }

        .footer {
            text-align: center;
            margin-top: 3mm;
            padding-top: 2mm;
            border-top: 1px dashed #000;
        }

        /* Print-specific styles */
        @media print {
            @page {
                margin: 0;
                size: 80mm auto;
            }

            body {
                width: 76mm;
                margin: 0;
                padding: 2mm;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>YOUR RESTAURANT NAME</h1>
        <p>Address Line 1</p>
        <p>Address Line 2</p>
        <p>Tel: xxx-xxx-xxxx</p>
    </div>

    <div class="order-info">
        <p>Order #<?php echo e($order['order_number']); ?></p>
        <p>Date: <?php echo e(now()->format('Y-m-d H:i:s')); ?></p>
    </div>

    <div class="items">
        <?php $__currentLoopData = $order['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <span><?php echo e($item['quantity']); ?>x <?php echo e($item['name']); ?></span>
                <span>$<?php echo e(number_format($item['price'], 2)); ?></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="total">
        <p>Total: $<?php echo e(number_format($order['total'], 2)); ?></p>
    </div>

    <div class="footer">
        <p>Thank you for your order!</p>
    </div>

    <?php if(isset($isPreview) && $isPreview): ?>
        <div class="no-print">
            <button onclick="window.print()">Print Receipt</button>
        </div>
    <?php endif; ?>
</body>

</html>
<?php /**PATH D:\installed-application\laragon\www\amigo\resources\views/admin/orders/thermal-print.blade.php ENDPATH**/ ?>