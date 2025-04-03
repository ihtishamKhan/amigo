

<?php $__env->startSection('title'); ?>
    Orders
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('/assets/libs/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
        .order-details>.horizontal {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .order-details p {
            margin-bottom: 0;
        }

        .order-details p strong {
            font-weight: 600;
        }

        .status-form {
            display: inline-block;
            margin-left: 10px;
        }

        .status-form select {
            border-radius: 0.25rem;
            padding: 0.25rem 0.5rem;
            border: 1px solid #ced4da;
            margin-right: 5px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Orders
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            <strong>Success!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-block-helper me-2"></i>
            <strong>Error!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="order-details">
                        <!-- Order Meta Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="gap-2">
                                    <small class="text-muted d-block">Order Date:</small>
                                    <span class="fw-bold"><?php echo e($order->created_at->format('d M Y h:i A')); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="gap-2">
                                    <small class="text-muted d-block">
                                        <?php if($order->order_type == 'delivery'): ?>
                                            Delivery Time:
                                        <?php else: ?>
                                            Pickup Time:
                                        <?php endif; ?>
                                    </small>
                                    <span class="fw-bold">
                                        <?php echo e($order->pickup_delivery_time->format('d M Y h:i A')); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Type & Status with Status Change Form -->
                        <div class="mb-4 d-flex align-items-center">
                            <span class="badge bg-primary me-2"><?php echo e(ucfirst($order->order_type)); ?>

                            </span>

                            <div class="me-2">
                                <?php if($order->status == 'created'): ?>
                                    <span class="badge bg-warning">Created</span>
                                <?php elseif($order->status == 'in-progress'): ?>
                                    <span class="badge bg-info">In Progress</span>
                                <?php elseif($order->status == 'completed'): ?>
                                    <span class="badge bg-success">Completed</span>
                                <?php elseif($order->status == 'cancelled'): ?>
                                    <span class="badge bg-danger">Cancelled</span>
                                <?php endif; ?>
                            </div>

                            <!-- Status Update Form -->
                            <form action="<?php echo e(route('orders.update-status', $order->id)); ?>" method="POST"
                                class="status-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <div class="d-flex align-items-center">
                                    <select name="status" class="form-select form-select-sm me-2">
                                        <option value="created" <?php echo e($order->status == 'created' ? 'selected' : ''); ?>>Created
                                        </option>
                                        <option value="in-progress" <?php echo e($order->status == 'in-progress' ? 'selected' : ''); ?>>
                                            In Progress</option>
                                        <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>
                                            Completed</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Update Status</button>
                                </div>
                            </form>

                            <!-- Cancel Order Button -->
                            <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal"
                                data-bs-target="#cancelOrderModal">
                                Cancel Order
                            </button>

                            <!-- Cancel Order Modal -->
                            <div class="modal fade show" id="cancelOrderModal" tabindex="-1"
                                aria-labelledby="cancelOrderModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelOrderModalLabel">Cancel Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to cancel this order?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="<?php echo e(route('orders.cancel', $order->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="btn btn-danger">Cancel Order</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="mb-4">
                            <h3 class="h5 mb-3">Customer Information</h3>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Name</small>
                                    <span class="fw-bold"><?php echo e($order->customer_name); ?></span>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Email</small>
                                    <span class="fw-bold"><?php echo e($order->customer_email); ?></span>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Phone</small>
                                    <span class="fw-bold"><?php echo e($order->customer_phone); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Information -->
                        <?php if($order->order_type == 'delivery'): ?>
                            <div class="mb-4">
                                <h3 class="h5 mb-3">Delivery Information</h3>
                                <div class="bg-light p-3 rounded">
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Delivery
                                            Address</small>
                                        <span class="fw-bold"><?php echo e($order->full_address); ?></span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Notes</small>
                                        <span class="fw-bold"><?php echo e($order->notes); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                        <!-- Order Items -->
                        <div>
                            <h3 class="h5 mb-3">Order Items</h3>

                            <!-- Headers -->
                            <div class="row m-0 bg-light py-2 mb-2 rounded fw-semibold d-none d-md-flex">
                                <div class="col-md-3">Item</div>
                                <div class="col-md-1">Qty</div>
                                <div class="col-md-2">Price</div>
                                <div class="col-md-2">Total</div>
                                <div class="col-md-4">Details</div>
                            </div>

                            <!-- Items List -->
                            <div class="order-items">
                                <!-- Item 1 -->
                                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row py-3 border-bottom">
                                        <div class="col-md-3">
                                            <div class="fw-medium">
                                                <?php echo e($item->orderable->name); ?>

                                            </div>
                                            <small class="text-muted">
                                                <?php if($item->orderable_type === 'App\Models\Product'): ?>
                                                    (Product)
                                                <?php elseif($item->orderable_type === 'App\Models\MealDeal'): ?>
                                                    (Meal Deal)
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="d-md-none text-muted small mb-1">
                                                Quantity:
                                            </div>
                                            <?php echo e($item->quantity); ?>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-md-none text-muted small mb-1">Price:
                                            </div>
                                            £<?php echo e(number_format($item->unit_price, 2)); ?>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-md-none text-muted small mb-1">Total:
                                            </div>
                                            £<?php echo e(number_format($item->subtotal, 2)); ?>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-md-none text-muted small mb-1">Details:</div>

                                            <?php if($item->orderable_type === 'App\Models\Product'): ?>
                                                <!-- Product Variation -->
                                                <?php if($item->productVariation): ?>
                                                    <div class="mb-2">
                                                        <span class="badge bg-secondary">Size:
                                                            <?php echo e($item->productVariation->name); ?></span>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Options -->
                                                <?php if($item->orderItemOptions->count() > 0): ?>
                                                    <div class="mb-2">
                                                        <strong class="d-block text-muted small">Options:</strong>
                                                        <?php $__currentLoopData = $item->orderItemOptions->groupBy('option_group_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupId => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="mb-1 ms-2">
                                                                <span
                                                                    class="text-muted small"><?php echo e($options->first()->optionGroup->name); ?>:</span>
                                                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <span class="badge bg-light text-dark">
                                                                        <?php echo e($option->name); ?>

                                                                        <?php if($option->price > 0): ?>
                                                                            (+£<?php echo e(number_format($option->price, 2)); ?>)
                                                                        <?php endif; ?>
                                                                    </span>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Addons -->
                                                <?php if($item->orderItemAddons->count() > 0): ?>
                                                    <div class="mb-2">
                                                        <strong class="d-block text-muted small">Addons:</strong>
                                                        <?php $__currentLoopData = $item->orderItemAddons->groupBy('addon_category_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryId => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="mb-1 ms-2">
                                                                <span
                                                                    class="text-muted small"><?php echo e($addons->first()->addonCategory->name); ?>:</span>
                                                                <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <span class="badge bg-light text-dark">
                                                                        <?php echo e($addon->name); ?>

                                                                        <?php if($addon->price > 0): ?>
                                                                            (+£<?php echo e(number_format($addon->price, 2)); ?>)
                                                                        <?php endif; ?>
                                                                    </span>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if($item->orderable_type === 'App\Models\MealDeal'): ?>
                                                
                                                <!-- Meal Deal Selections -->
                                                <?php if($item->mealDealItems->count() > 0): ?>
                                                    <div>
                                                        <strong class="d-block text-muted small">Selections:</strong>
                                                        <?php $__currentLoopData = $item->mealDealItems->groupBy('meal_deal_section_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionId => $selections): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="mb-1 ms-2">
                                                                <span
                                                                    class="text-muted small"><?php echo e($selections->first()->section->name); ?>:</span>
                                                                <?php $__currentLoopData = $selections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <span
                                                                        class="badge bg-light text-dark"><?php echo e($selection->name); ?></span>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Total -->
                                <div class="row mt-3">
                                    <div class="col-md-8 text-md-end">
                                        <strong>Total Amount:</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>
                                            £<?php echo e(number_format($order->total, 2)); ?>

                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/datatables.init.js')); ?>"></script>

    <script>
        // Initialize Bootstrap Modal
        document.addEventListener('DOMContentLoaded', function() {
            // Get the cancel order button and modal elements
            const cancelButton = document.querySelector('[data-bs-target="#cancelOrderModal"]');
            const cancelModal = document.getElementById('cancelOrderModal');

            if (cancelButton && cancelModal) {
                // Create the Bootstrap modal instance
                const modal = new bootstrap.Modal(cancelModal);

                // Add click event listener to the cancel button
                cancelButton.addEventListener('click', function() {
                    modal.show();
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\installed-application\laragon\www\amigo\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>