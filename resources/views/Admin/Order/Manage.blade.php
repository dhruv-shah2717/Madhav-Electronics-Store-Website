@extends('Admin/Master')

@section('section')

<!-- Start of Manage Order Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Order Total</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['ord'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $tem->payment_id }}</td>
                                            <td>₹ {{ number_format($tem->order_total) }}</td> <!-- Format total price -->
                                            <td>
                                                @if($tem->payment_status != "Pending")
                                                    @if($tem->order_status == 'Ordered')
                                                        <p style="color: blue">Ordered at</p>
                                                        <p class="date">{{ \Carbon\Carbon::parse($tem->order_date)->format('d-m-Y') }}</p>
                                                    @elseif($tem->order_status == 'Shipped')
                                                        <p style="color: blue">Shipped at</p>
                                                        <p>{{ \Carbon\Carbon::parse($tem->shipped_date)->format('d-m-Y') }}</p>
                                                    @elseif($tem->order_status == 'Delivered')
                                                        <p style="color: green">Delivered at</p>
                                                        <p>{{ \Carbon\Carbon::parse($tem->delivered_date)->format('d-m-Y') }}</p>
                                                    @elseif($tem->order_status == 'Cancelled')
                                                        <p style="color: red">Cancelled at</p>
                                                        <p>{{ \Carbon\Carbon::parse($tem->cancle_date)->format('d-m-Y') }}</p>
                                                    @endif
                                                @else
                                                    <p style="color: red">Pending</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($tem->payment_status == 'Paid')
                                                    <p style="color: green; font-weight:bold;">Paid</p>
                                                @elseif($tem->payment_status == 'Refund')
                                                    <p style="color: red; font-weight:bold;">Refund</p>
                                                @else
                                                    <p style="color: red; font-weight:bold;">Pending</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('download.ord', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Invoice</button>
                                                </a>
                                                <a href="{{ route('edit.ord', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </a>
                                                <a href="{{ route('delete.ord', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $i++; // Increment counter
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End of Manage Order Section -->

@endsection