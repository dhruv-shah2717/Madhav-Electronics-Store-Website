<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <style>
        html, body {
            font-family: sans-serif;
        }
        p {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
        }
        table, th, td {
            padding: 8px;
            font-size: 14px;
        }
        .heading {
            font-size: 21px;
            margin: 12px 0;
        }
        .small-heading {
            font-size: 18px;
        }
        .total-heading {
            font-size: 15px;
            font-weight: 500;
        }
        .ctotal-heading {
            font-size: 18px;
            font-weight: 700;
        }
        .order-details tbody tr td:nth-child(1),
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }
        .text-start { text-align: left; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-size: 14px;
            font-weight: 400;
        }
        .bg-blue {
            color: black;
        }
        .status {
            font-weight: bold;
        }
        .status.paid { color: green; }
        .status.pending { color: red; }
        .status.refund { color: red; }
        .status.ordered { color: blue; }
        .status.shipped { color: blue; }
        .status.delivered { color: green; }
        .status.cancelled { color: red; }
    </style>
</head>
<body>

    <!-- Order Summary Table -->
    <table class="order-details">
        <thead>
            <tr>
                <th colspan="2" width="50%">
                    <h1>Madhav</h1>
                </th>
                <th colspan="2" width="50%" class="text-end company-data">
                    <span>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</span><br>
                    <span>Zip code: {{ $order->shipped_pincode }}</span><br>
                    <span>State: {{ $order->shipped_state }}</span><br>
                    <span>City/District/Town: {{ $order->shipped_cdt }}</span><br><br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th colspan="2">Order Details</th>
                <th colspan="2">Shipping Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->_id }}</td>
                <td>Full Name:</td>
                <td>{{ $order->shipped_name }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ $order->payment_id }}</td>
                <td>Email Id:</td>
                <td>{{ $order->shipped_email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                <td>Phone:</td>
                <td>{{ $order->shipped_phone }}</td>
            </tr>
            <tr>
                <td>Payment Status:</td>
                <td>
                    <p class="status {{ strtolower($order->payment_status) }}">{{ $order->payment_status }}</p>
                </td>
                <td>Address:</td>
                <td>{{ $order->shipped_address }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>
                    <p class="status {{ strtolower($order->order_status) }}">{{ $order->order_status }}</p>
                </td>
                <td>Pin code:</td>
                <td>{{ $order->shipped_pincode }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Order Items Table -->
    <table>
        <thead>
            <tr>
                <th class="text-start heading" colspan="5">Order Items</th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productIds as $index => $productId)
                <tr>
                    <td width="10%">{{ $loop->iteration }}</td>
                    <td>{{ $products[$productId] ?? 'Unknown' }}</td>
                    <td width="10%">{{ $qty[$index] ?? 0 }}</td>
                    <td width="10%">{{ number_format($price[$index] ?? 0) }}</td>
                    <td width="15%">{{ number_format(($qty[$index] ?? 0) * ($price[$index] ?? 0)) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total-heading">Total Amount:</td>
                <td colspan="1" class="total-heading"><b>{{ number_format($order->order_total + $order->order_coupon) }}</b></td>
            </tr>

            @if($order->order_coupon != "")
                <tr>
                    <td colspan="4" class="total-heading">Coupon:</td>
                    <td colspan="1" class="total-heading" style="color: green;"><b>{{ number_format($order->order_coupon) }}</b></td>
                </tr>
            @endif

            <tr>
                <td colspan="4" class="ctotal-heading">Sub Total Amount:</td>
                <td colspan="1" class="ctotal-heading">{{ number_format($order->order_total) }}</td>
            </tr>
        </tbody>
    </table>

    <p class="text-center">Thank you for shopping with Madhav Electronics Store</p>

</body>
</html>