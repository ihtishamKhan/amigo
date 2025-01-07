

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
                <div class="d-flex justify-content-end align-items-center p-2">

                    

                    
                    

                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Cust. Name</th>
                                <th>Location</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($order->id); ?></td>
                                    <td><?php echo e($order->created_at->format('d M Y h:i A')); ?></td>
                                    <td><?php echo e($order->customer_name); ?></td>
                                    <td><?php echo e($order->full_address); ?></td>
                                    <td>£<?php echo e($order->total); ?></td>
                                    <td>
                                        <?php if($order->status == 'created'): ?>
                                            <span class="badge bg-success">Created</span>
                                        <?php elseif($order->status == 'preparing'): ?>
                                            <span class="badge bg-warning">Preparing</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Delivered</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#view-order-<?php echo e($order->id); ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="<?php echo e(route('orders.printTest', $order->id)); ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <?php if (\Illuminate\Support\Facades\Blade::check('hasrole', 'Admin')): ?>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-order-<?php echo e($order->id); ?>"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        
                                    </td>
                                </tr>

                                
                                <div id="edit-task-<?php echo e($order->id); ?>" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Task</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="title"
                                                                    class="form-label required">Title</label>
                                                                <input type="text" name="title"
                                                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    id="title" value="<?php echo e($order->title); ?>">

                                                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="description"
                                                                    class="form-label required">Description</label>
                                                                <textarea name="description" class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description"
                                                                    cols="30" rows="2" required><?php echo e($order->description); ?></textarea>

                                                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="priority"
                                                                    class="form-label required">Priority</label>
                                                                <select name="priority"
                                                                    class="form-select <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    id="priority" required>
                                                                    <option value="">Select Priority</option>
                                                                    <option value="low"
                                                                        <?php echo e($order->priority == 'low' ? 'selected' : ''); ?>>
                                                                        Low</option>
                                                                    <option value="medium"
                                                                        <?php echo e($order->priority == 'medium' ? 'selected' : ''); ?>>
                                                                        Medium</option>
                                                                    <option value="high"
                                                                        <?php echo e($order->priority == 'high' ? 'selected' : ''); ?>>
                                                                        High</option>
                                                                </select>

                                                                <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="task-status"
                                                                    class="form-label required">Status</label>
                                                                <select name="status"
                                                                    class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    id="task-status" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="created"
                                                                        <?php echo e($order->status == 'created' ? 'selected' : ''); ?>>
                                                                        Created</option>
                                                                    <option value="in-progress"
                                                                        <?php echo e($order->status == 'in-progress' ? 'selected' : ''); ?>>
                                                                        In Progress</option>
                                                                    <option value="completed"
                                                                        <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>
                                                                        Completed</option>
                                                                </select>

                                                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="assign-to" class="form-label required">Assign
                                                                    To</label>
                                                                <select name="employee_id"
                                                                    class="form-select <?php $__errorArgs = ['employee_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    id="assign-to" required>
                                                                    <option value="">Select Employee</option>

                                                                </select>

                                                                <?php $__errorArgs = ['employee_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light">Save</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                

                                
                                <div id="view-order-<?php echo e($order->id); ?>" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">View Order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="order-details">
                                                    <!-- Order Meta Info -->
                                                    <div class="row g-3 mb-4">
                                                        <div class="col-md-6">
                                                            <div class="gap-2">
                                                                <small class="text-muted d-block">Order Date:</small>
                                                                <span
                                                                    class="fw-bold"><?php echo e($order->created_at->format('d M Y h:i A')); ?></span>
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

                                                    <!-- Order Type & Status -->
                                                    <div class="mb-4">
                                                        <span
                                                            class="badge bg-primary me-2"><?php echo e(ucfirst($order->order_type)); ?>

                                                        </span>

                                                        <?php if($order->status == 'created'): ?>
                                                            <span class="badge bg-warning">Created</span>
                                                        <?php elseif($order->status == 'in-progress'): ?>
                                                            <span class="badge bg-info">In Progress</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-success">Completed</span>
                                                        <?php endif; ?>
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
                                                                    <span
                                                                        class="fw-bold"><?php echo e($order->full_address); ?></span>
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
                                                        <div
                                                            class="row m-0 bg-light py-2 mb-2 rounded fw-semibold d-none d-md-flex">
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
                                                                        £<?php echo e(number_format($item->orderable->price, 2)); ?>

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="d-md-none text-muted small mb-1">Total:
                                                                        </div>
                                                                        £<?php echo e(number_format($item->orderable->price * $item->quantity, 2)); ?>

                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="d-md-none text-muted small mb-1">
                                                                            Details:
                                                                        </div>
                                                                        <small class="text-muted">
                                                                            <?php echo e($item->orderable->description); ?>

                                                                        </small>
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div> <!-- end col -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/datatables.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\installed-application\laragon\www\amigo\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>