<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Print</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}">

    <style>
        .invoice-box {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>

</head>
<body onload="window.print();">

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ asset('assets/site/images/logo-2.png') }}" alt="Lara-Ecomm logo" style="width:100%; max-width:300px;">
                        </td>

                        <td>
                            Invoice No. : #{{ $order->id }}<br>
                            Created: {{ date('F d (D) Y') }}<br>
                            Due: {{ $order->total }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <p id="address">
                                799/A, 1 No Lane,<br>
                                Dhumpara, Chittagong Wasa,<br>
                                Bangladesh.<br>
                                +(880) 123-456
                                +(880) 456-789<br>
                                lara.ecomm@gmail.com
                            </p>
                        </td>

                        <td>
                            <p id="customer-title">
                                {{ $order->customer->name }}<br>
                                {{ $order->customer->email }}<br>
                                {{ $order->customer->phone }}<br>
                                {{ $order->shipping->address }}<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment
            </td>

            <td>
                Method #
            </td>
        </tr>

        <tr class="details">
            <td>
                On
            </td>

            <td>
                # {{ $order->payment->type }}
            </td>
        </tr>

        <tr class="heading">
            <td>
                Item
            </td>

            <td>
                Price
            </td>
        </tr>

        @foreach($order->orderItems as $order_item)
        <tr class="item">
            <td>
                {{ $order_item->product_name }}
            </td>
            <td>
                &#2547; {{ $order_item->product_price * $order_item->product_qty }}.00
            </td>
        </tr>
        @endforeach

        <tr class="total">
            <td></td>

            <td>
                Sub Total: &#2547; {{ $order->total }}.00
                <p>Shipping Charge: &#2547; {{ $order->shipping->shipping_charge }}</p>
                <hr>
                <p>Total: &#2547; {{ $order->total + $order->shipping->shipping_charge }}.00</p>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
