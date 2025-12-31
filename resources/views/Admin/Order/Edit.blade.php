@extends('Admin/Master')

@section('section')

<!-- Start of Edit Order Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.ord', $data['ord']->_id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Orders</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-2">User ID</h5>
                                    <input type="text" class="form-control" name="user_id" value="{{ $data['ord']->user_id }}">
                                    @error('user_id')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Product ID</h5>
                                    <input type="text" class="form-control" name="product_id" value="{{ $data['ord']->product_id }}">
                                    @error('product_id')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Order Quantity</h5>
                                    <input type="text" class="form-control" name="order_qty" value="{{ $data['ord']->order_qty }}">
                                    @error('order_qty')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Order Price</h5>
                                    <input type="text" class="form-control" name="order_price" value="{{ $data['ord']->order_price }}">
                                    @error('order_price')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Order Total</h5>
                                    <input type="text" class="form-control" name="order_total" value="{{ $data['ord']->order_total }}">
                                    @error('order_total')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Order Coupon</h5>
                                    <input type="text" class="form-control" name="order_coupon" value="{{ $data['ord']->order_coupon }}">
                                    @error('order_coupon')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Order Date</h5>
                                    <input type="date" class="form-control" name="order_date" value="{{ \Carbon\Carbon::parse($data['ord']->order_date)->format('Y-m-d') }}">
                                    @error('order_date')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Order Status</h5>
                                    <select class="form-select" name="order_status">
                                        <option value="Pending" {{ $data['ord']->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Shipped" {{ $data['ord']->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="Delivered" {{ $data['ord']->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="Ordered" {{ $data['ord']->order_status == 'Ordered' ? 'selected' : '' }}>Ordered</option>
                                        <option value="Cancelled" {{ $data['ord']->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('order_status')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Payment Date</h5>
                                    <input type="date" class="form-control" name="payment_date" value="{{ \Carbon\Carbon::parse($data['ord']->payment_date)->format('Y-m-d') }}">
                                    @error('payment_date')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Payment Status</h5>
                                    <select class="form-select" name="payment_status">
                                        <option value="Pending" {{ $data['ord']->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Paid" {{ $data['ord']->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="Refund" {{ $data['ord']->payment_status == 'Refund' ? 'selected' : '' }}>Refund</option>
                                    </select>
                                    @error('payment_status')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Payment ID</h5>
                                    <input type="text" class="form-control" name="payment_id" value="{{ $data['ord']->payment_id }}">
                                    @error('payment_id')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped Name</h5>
                                    <input type="text" class="form-control" name="shipped_name" value="{{ $data['ord']->shipped_name }}">
                                    @error('shipped_name')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped Email</h5>
                                    <input type="email" class="form-control" name="shipped_email" value="{{ $data['ord']->shipped_email }}">
                                    @error('shipped_email')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped Phone</h5>
                                    <input type="text" class="form-control" name="shipped_phone" value="{{ $data['ord']->shipped_phone }}">
                                    @error('shipped_phone')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped Address</h5>
                                    <input type="text" class="form-control" name="shipped_address" value="{{ $data['ord']->shipped_address }}">
                                    @error('shipped_address')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped Pincode</h5>
                                    <input type="text" class="form-control" name="shipped_pincode" value="{{ $data['ord']->shipped_pincode }}">
                                    @error('shipped_pincode')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped State</h5>
                                    <input type="text" class="form-control" name="shipped_state" value="{{ $data['ord']->shipped_state }}">
                                    @error('shipped_state')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Shipped City/District/Town</h5>
                                    <input type="text" class="form-control" name="shipped_cdt" value="{{ $data['ord']->shipped_cdt }}">
                                    @error('shipped_cdt')
                                        <div style="color:red; font-size:13px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Edit Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Order Section -->

@endsection