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

                <div class="card-body">
                    <div class="order-details">
                        <!-- Order Meta Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="gap-2">
                                    <small class="text-muted d-block">Order Date:</small>
                                    <span class="fw-bold">{{ $order->created_at->format('d M Y h:i A') }}</span>
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

                        <!-- Order Type & Status with Status Change Form -->
                        <div class="mb-4 d-flex align-items-center">
                            <span class="badge bg-primary me-2">{{ ucfirst($order->order_type) }}
                            </span>

                            <div class="me-2">
                                @if ($order->status == 'created')
                                    <span class="badge bg-warning">Created</span>
                                @elseif ($order->status == 'in-progress')
                                    <span class="badge bg-info">In Progress</span>
                                @elseif ($order->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif ($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </div>

                            <!-- Status Update Form -->
                            <form action="{{ route('orders.update-status', $order->id) }}" method="POST"
                                class="status-form">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex align-items-center">
                                    <select name="status" class="form-select form-select-sm me-2">
                                        <option value="created" {{ $order->status == 'created' ? 'selected' : '' }}>Created
                                        </option>
                                        <option value="in-progress" {{ $order->status == 'in-progress' ? 'selected' : '' }}>
                                            In Progress</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
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
                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
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
                                        <span class="fw-bold">{{ $order->full_address }}</span>
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
                                            £{{ number_format($item->unit_price, 2) }}
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-md-none text-muted small mb-1">Total:
                                            </div>
                                            £{{ number_format($item->subtotal, 2) }}
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-md-none text-muted small mb-1">Details:</div>

                                            @if ($item->orderable_type === 'App\Models\Product')
                                                <!-- Product Variation -->
                                                @if ($item->productVariation)
                                                    <div class="mb-2">
                                                        <span class="badge bg-secondary">Size:
                                                            {{ $item->productVariation->name }}</span>
                                                    </div>
                                                @endif

                                                <!-- Options -->
                                                @if ($item->orderItemOptions->count() > 0)
                                                    <div class="mb-2">
                                                        <strong class="d-block text-muted small">Options:</strong>
                                                        @foreach ($item->orderItemOptions->groupBy('option_group_id') as $groupId => $options)
                                                            <div class="mb-1 ms-2">
                                                                <span
                                                                    class="text-muted small">{{ $options->first()->optionGroup->name }}:</span>
                                                                @foreach ($options as $option)
                                                                    <span class="badge bg-light text-dark">
                                                                        {{ $option->name }}
                                                                        @if ($option->price > 0)
                                                                            (+£{{ number_format($option->price, 2) }})
                                                                        @endif
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <!-- Addons -->
                                                @if ($item->orderItemAddons->count() > 0)
                                                    <div class="mb-2">
                                                        <strong class="d-block text-muted small">Addons:</strong>
                                                        @foreach ($item->orderItemAddons->groupBy('addon_category_id') as $categoryId => $addons)
                                                            <div class="mb-1 ms-2">
                                                                <span
                                                                    class="text-muted small">{{ $addons->first()->addonCategory->name }}:</span>
                                                                @foreach ($addons as $addon)
                                                                    <span class="badge bg-light text-dark">
                                                                        {{ $addon->name }}
                                                                        @if ($addon->price > 0)
                                                                            (+£{{ number_format($addon->price, 2) }})
                                                                        @endif
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($item->orderable_type === 'App\Models\MealDeal')
                                                <!-- Meal Deal Selections -->
                                                @if ($item->mealDealItems->count() > 0)
                                                    <div>
                                                        <strong class="d-block text-muted small">Selections:</strong>
                                                        @foreach ($item->mealDealItems->groupBy('meal_deal_section_id') as $sectionId => $selections)
                                                            <div class="mb-1 ms-2">
                                                                <span
                                                                    class="text-muted small">{{ $selections->first()->section->name }}:</span>
                                                                @foreach ($selections as $selection)
                                                                    <span
                                                                        class="badge bg-light text-dark">{{ $selection->name }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endif
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
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>

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
@endsection
