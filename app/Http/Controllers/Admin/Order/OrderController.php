<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Mail\OrderInfoMail;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Using EORM...
        $orders = Order::with('customer', 'shipping', 'payment', 'orderItems')->select('id', 'customer_id', 'shipping_id', 'total', 'status')->latest()->get();

        // Using DB Query Builder...
//        $orders = Order::with('customer', 'shipping', 'orderItems')
//                        ->leftJoin('payments', 'payments.order_id', '=', 'orders.id')
//                        ->select( 'orders.id', 'orders.customer_id', 'orders.shipping_id', 'orders.total', 'orders.status', 'orders.created_at', 'payments.id as p_id', 'payments.type as p_type', 'payments.status as p_status')
//                        ->orderBy('id', 'desc')
//                        ->get();

//        return $orders;

        $order_items = OrderItem::with('product', 'order')->latest()->get();
//        return $order_items;
        return view('admin.order.index', compact('orders', 'order_items'));
    }

    /**
     * @param $order_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($order_id) {
        $order_id = base64_decode($order_id);
        $order = Order::with('customer', 'shipping', 'payment', 'orderItems')->where('id', $order_id)->first();

        return view('admin.order.show', compact('order'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            $order = Order::find($request->id);
            $order->status = $request->order_status;
            $order->update();

            $payment = Payment::with('order')->where('order_id', $request->id)->first();
            $payment->status = $request->payment_status;
            $payment->update();
            getMessage('success', 'Success, Order status && Pending status has been updated.');
            return redirect()->back();

        } catch (Exception $e) {
            getMessage('danger', 'Error : ' . $e->getMessage());
        }


    }

    /**
     * @param $payment_id
     * @param $payment_status
     */
    //    UPDATED ORDER STATUS ACTIVE/INACTIVE PROCESSING...
    public function updatePaymentStatus($payment_id, $payment_status)
    {
        // return $category_id . ' ' . $category_status;
        $payment_detail = Payment::find($payment_id);
        $payment_detail->status = $payment_status;
        $payment_detail->save();

    }

    /**
     * @param Request $request
     */
    public function orderStatusUpdate(Request $request) {
        try {
            if($request->ajax()) {
                $order = Order::find($request->id);
                $order->status = $request->order_status;
                $order->update();
                getMessage('success', 'Order status has been updated.');

            }

        } catch (Exception $e) {
            getMessage('danger', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     */
    public function paymentStatusUpdate(Request $request) {
        try {
            if($request->ajax()) {
                $payment = Payment::find($request->id);
                $payment->status = $request->payment_status;
                $payment->update();
                getMessage('success', 'Payment status has been updated.');

            }

        } catch (Exception $e) {
            getMessage('danger', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     */
    public function shippingChargeUpdate(Request $request) {
        if($request->ajax()) {
            $shipping = Shipping::find($request->id);
            $shipping->shipping_charge = $request->shipping_charge;
            $shipping->update();
            getMessage('success', 'Shipping Charge has been updated.');

        }
    }

    public function orderInvoice($order_id) {
        $order_id = base64_decode($order_id);
        $order = Order::with('customer', 'shipping', 'payment', 'orderItems')->where('id', $order_id)->first();
        return view('admin.order.order-invoice', compact('order'));
    }

    /**
     * @param Request $request
     */
    public function orderInfoMail(Request $request) {
        $customer = Customer::find($request->customer_id);
        $customer_mail = $customer->email;
        $all_order_info = [
            'order_details' => $request->order_info,
        ];

        Mail::to($customer_mail)->send(new OrderInfoMail($all_order_info));
        getMessage('success', 'Order has been send successfully done to customer.');

        return redirect()->back();


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request) {
        if($request->ajax()) {
            $id =  base64_decode($request->id);
//            return $id;
            $order = Order::find($id);
            $order_delete = $order->delete();
            if($order_delete) {
                getMessage('success', 'Success, Order has been deleted.');
                return response()->json(['status' => 'Poof! Your Order has been deleted.']);

            } else {
                getMessage('danger', 'Success, Order has not been deleted!');
                return response()->json(['status' => 'Poof! Your Order has not been deleted!']);
            }

        }

    }

    public function orderInvoicePrint($order_id) {
        $order_id = base64_decode($order_id);
        $order = Order::with('customer', 'shipping', 'payment', 'orderItems')->where('id', $order_id)->first();
        return view('admin.order.order-invoice-print', compact('order'));
    }


}
