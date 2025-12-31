@extends('User/Master')

@section('section')

<!-- Start of Order Section -->
    <section class="order-section Dhruv">
        <div class="container">

            @if(count($data['ord']) > 0)
                <div class="row">
                    <!-- Order Table -->
                    <div class="order-table">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="table-heading">Product</th>
                                        <th class="table-heading">Total</th>
                                        <th class="table-heading">Status</th>
                                        <th class="table-heading">Order ID</th>
                                        <th class="table-heading">Pay</th>
                                        <th class="table-heading">Invoice</th>
                                        <th class="table-heading"></th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    
                                    @foreach($data['ord'] as $tem)
                                        <tr>
                                            <td class="item-name">
                                                @php
                                                    $productIds = json_decode($tem->product_id);
                                                    $i = 1;
                                                @endphp

                                                @foreach($productIds as $productId)
                                                    <p>
                                                        <span>{{ $i }}.</span> 
                                                        {{ $data['pro'][$productId] }}
                                                    </p>
                                                    @php $i++; @endphp    
                                                @endforeach
                                            </td>

                                            <td class="item-total">
                                                <p>₹ {{ number_format($tem->order_total) }}</p>
                                            </td> 

                                            <td class="item-status">
                                                @if($tem->payment_status != "Pending")
                                                    @if($tem->order_status == 'Ordered')
                                                        <p class="status" style="color: blue">Ordered at</p>
                                                        <p class="date">{{ \Carbon\Carbon::parse($tem->order_date)->format('d-m-Y') }}</p>
                                                    @elseif($tem->order_status == 'Shipped')
                                                        <p class="status" style="color: blue">Shipped at</p>
                                                        <p class="date">{{ \Carbon\Carbon::parse($tem->shipped_date)->format('d-m-Y') }}</p>
                                                    @elseif($tem->order_status == 'Delivered')
                                                        <p class="status" style="color: green">Delivered at</p>
                                                        <p class="date">{{ \Carbon\Carbon::parse($tem->delivered_date)->format('d-m-Y') }}</p>
                                                    @elseif($tem->order_status == 'Cancelled')
                                                        <p class="status" style="color: red">Cancelled at</p>
                                                        <p class="date">{{ \Carbon\Carbon::parse($tem->cancle_date)->format('d-m-Y') }}</p>
                                                    @endif
                                                @else
                                                    <p class="status" style="color: red">Pending</p>
                                                @endif
                                            </td>

                                            <td class="item-paymentid">
                                                <p>{{ $tem->payment_id }}</p>
                                            </td> 

                                            <td class="item-payment-status">
                                                @if($tem->payment_status == 'Paid')
                                                    <p style="color: green;">Paid</p>
                                                @elseif($tem->payment_status == 'Refund')
                                                    <p style="color: red;">Refund</p>
                                                @else
                                                    <p style="color: red;">Pending</p>
                                                @endif
                                            </td>

                                            <td class="item-invoice">
                                                <a href="{{ route('download.invoice', $tem->_id) }}">
                                                    <img src="{{ asset('Images/Background/Invoice.png') }}" alt="Invoice">
                                                    <p>Download</p>
                                                </a>
                                            </td>

                                            <td class="item-buttons">
                                                @if($tem->payment_status == 'Pending')
                                                    <form action="{{ route('repayment') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="raz" value="{{ $tem->_id }}">
                                                        <button class="btn btn-outline-success btn-sm" type="submit">Pay Now</button>
                                                    </form>
                                                @else
                                                    @if($tem->order_status == "Delivered")
                                                        {{-- <a href="#"><i class="bi bi-star-fill"></i> Rate & Review Product</a> --}}
                                                    @elseif($tem->payment_status != "Refund" && $tem->order_status != "Cancelled")
                                                        <a href="{{ route('canorder.action', $tem->_id) }}">
                                                            <button class="btn btn-outline-danger btn-sm">Cancel Order</button>
                                                        </a>
                                                    @endif 
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
            @else
                <!-- Empty Order Message -->
                <div class="d-flex justify-content-center w-100">
                    <img src="{{ asset('Images/Background/Orderempty.png') }}" alt="No Orders" style="height: 450px; width: 450px;" class="img-fluid">
                </div>
            @endif

        </div>
    </section>
<!-- End of Order Section -->

@endsection