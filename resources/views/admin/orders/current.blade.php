@extends('layouts.master')

@section('title')
    Orders
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
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
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Orders
        @endslot
        @slot('title')
            List
        @endslot
    @endcomponent

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-block-helper me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->full_address }}</td>
                                    <td>£{{ $order->total }}</td>
                                    <td>
                                        @if ($order->status == 'created')
                                            <span class="badge bg-warning">Created</span>
                                        @elseif ($order->status == 'preparing')
                                            <span class="badge bg-warning">Preparing</span>
                                        @elseif ($order->status == 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @elseif ($order->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif ($order->status == 'delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('orders.printReceipt', $order->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        @hasrole('Admin')
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-order-{{ $order->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endhasrole
                                        {{-- <form action="#" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>

                                {{-- edit task popup --}}
                                <div id="edit-task-{{ $order->id }}" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Task</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="title"
                                                                    class="form-label required">Title</label>
                                                                <input type="text" name="title"
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    id="title" value="{{ $order->title }}">

                                                                @error('title')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="description"
                                                                    class="form-label required">Description</label>
                                                                <textarea name="description" class="form-control @error('category') is-invalid @enderror" id="description"
                                                                    cols="30" rows="2" required>{{ $order->description }}</textarea>

                                                                @error('description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="priority"
                                                                    class="form-label required">Priority</label>
                                                                <select name="priority"
                                                                    class="form-select @error('priority') is-invalid @enderror"
                                                                    id="priority" required>
                                                                    <option value="">Select Priority</option>
                                                                    <option value="low"
                                                                        {{ $order->priority == 'low' ? 'selected' : '' }}>
                                                                        Low</option>
                                                                    <option value="medium"
                                                                        {{ $order->priority == 'medium' ? 'selected' : '' }}>
                                                                        Medium</option>
                                                                    <option value="high"
                                                                        {{ $order->priority == 'high' ? 'selected' : '' }}>
                                                                        High</option>
                                                                </select>

                                                                @error('priority')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="task-status"
                                                                    class="form-label required">Status</label>
                                                                <select name="status"
                                                                    class="form-select @error('status') is-invalid @enderror"
                                                                    id="task-status" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="created"
                                                                        {{ $order->status == 'created' ? 'selected' : '' }}>
                                                                        Created</option>
                                                                    <option value="in-progress"
                                                                        {{ $order->status == 'in-progress' ? 'selected' : '' }}>
                                                                        In Progress</option>
                                                                    <option value="completed"
                                                                        {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                                        Completed</option>
                                                                </select>

                                                                @error('status')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="assign-to" class="form-label required">Assign
                                                                    To</label>
                                                                <select name="employee_id"
                                                                    class="form-select @error('employee_id') is-invalid @enderror"
                                                                    id="assign-to" required>
                                                                    <option value="">Select Employee</option>

                                                                </select>

                                                                @error('employee_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
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
                                {{-- end edit task popup --}}

                                {{-- view order popup --}}
                                <div id="view-order-{{ $order->id }}" class="modal fade" tabindex="-1"
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
                                                                    class="fw-bold">{{ $order->created_at->format('d M Y h:i A') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="gap-2">
                                                                <small class="text-muted d-block">
                                                                    @if ($order->order_type == 'delivery')
                                                                        Delivery Time:
                                                                    @else
                                                                        Pickup Time:
                                                                    @endif
                                                                </small>
                                                                <span class="fw-bold">
                                                                    {{ $order->pickup_delivery_time->format('d M Y h:i A') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Order Type & Status -->
                                                    <div class="mb-4">
                                                        <span
                                                            class="badge bg-primary me-2">{{ ucfirst($order->order_type) }}
                                                        </span>

                                                        @if ($order->status == 'created')
                                                            <span class="badge bg-warning">Created</span>
                                                        @elseif ($order->status == 'in-progress')
                                                            <span class="badge bg-info">In Progress</span>
                                                        @else
                                                            <span class="badge bg-success">Completed</span>
                                                        @endif
                                                    </div>

                                                    <!-- Customer Information -->
                                                    <div class="mb-4">
                                                        <h3 class="h5 mb-3">Customer Information</h3>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">Name</small>
                                                                <span class="fw-bold">{{ $order->customer_name }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">Email</small>
                                                                <span class="fw-bold">{{ $order->customer_email }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">Phone</small>
                                                                <span class="fw-bold">{{ $order->customer_phone }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delivery Information -->
                                                    @if ($order->order_type == 'delivery')
                                                        <div class="mb-4">
                                                            <h3 class="h5 mb-3">Delivery Information</h3>
                                                            <div class="bg-light p-3 rounded">
                                                                <div class="mb-2">
                                                                    <small class="text-muted d-block">Delivery
                                                                        Address</small>
                                                                    <span
                                                                        class="fw-bold">{{ $order->full_address }}</span>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted d-block">Notes</small>
                                                                    <span class="fw-bold">{{ $order->notes }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


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
                                                            @foreach ($order->orderItems as $item)
                                                                <div class="row py-3 border-bottom">
                                                                    <div class="col-md-3">
                                                                        <div class="fw-medium">
                                                                            {{ $item->orderable->name }}
                                                                        </div>
                                                                        <small class="text-muted">
                                                                            @if ($item->orderable_type === 'App\Models\Product')
                                                                                (Product)
                                                                            @elseif($item->orderable_type === 'App\Models\MealDeal')
                                                                                (Meal Deal)
                                                                            @endif
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="d-md-none text-muted small mb-1">
                                                                            Quantity:
                                                                        </div>
                                                                        {{ $item->quantity }}
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="d-md-none text-muted small mb-1">Price:
                                                                        </div>
                                                                        £{{ number_format($item->orderable->price, 2) }}
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="d-md-none text-muted small mb-1">Total:
                                                                        </div>
                                                                        £{{ number_format($item->orderable->price * $item->quantity, 2) }}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="d-md-none text-muted small mb-1">
                                                                            Details:
                                                                        </div>
                                                                        <small class="text-muted">
                                                                            {{ $item->orderable->description }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            <!-- Total -->
                                                            <div class="row mt-3">
                                                                <div class="col-md-8 text-md-end">
                                                                    <strong>Total Amount:</strong>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <strong>
                                                                        £{{ number_format($order->total, 2) }}
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
                                {{-- end view order popup --}}
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
