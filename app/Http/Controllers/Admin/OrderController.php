<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\Orders\FinishNotify;
use App\Notifications\Orders\AcceptNotify;
use App\Notifications\Orders\CancelNotify;
use App\Notifications\Orders\InProgressNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function orderCurrent()
    {
        $orders = Order::where('status', Order::STATUS_NEW)->latest()->get();
        return view('admin.orders.current', compact('orders'));
    }

    public function orderInProgress()
    {
        $orders = Order::where('status', Order::STATUS_INPROGRESS)->get();
        return view('admin.orders.in_progress', compact('orders'));
    }

    public function orderFinished()
    {
        $orders = Order::where('status', Order::STATUS_FINISHED_ADMIN)->get();
        return view('admin.orders.finished', compact('orders'));
    }
    public function orderComplete()
    {
        $orders = Order::where('status', Order::STATUS_COMPLETE_USER)->get();
        return view('admin.orders.complete', compact('orders'));
    }

    public function ordersCanceled()
    {
        $orders = Order::where('status', Order::STATUS_CANCEL)->get();
        return view('admin.orders.canceled', compact('orders'));
    }
    public function ordersShow($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.orders.show',compact('order'));
    }

    public function changeOrderStatus($order_id,$status)
    {
        $status =  (int)$status;

        $order = Order::findOrFail($order_id);
        if($status == Order::STATUS_INPROGRESS){
            $order->update(['status' => Order::STATUS_INPROGRESS]);
            Notification::send($order->user, new InProgressNotify($order));
            return redirect()->back()->with(['success' =>  __('dashboard.status_changed_successfully')]);
        }elseif ($status == Order::STATUS_FINISHED_ADMIN){
            $order->update(['status' => Order::STATUS_FINISHED_ADMIN,'pay_status'=> Order::PAY_STATUS_DONE]);
            Notification::send($order->user, new FinishNotify($order));

            return redirect()->back()->with(['success' => __('dashboard.status_changed_successfully')]);
        }
        elseif ($status == Order::STATUS_CANCEL){
//            dd($status);
            $order->update(['status' => Order::STATUS_CANCEL]);
            Notification::send($order->user, new CancelNotify($order));
            return redirect()->back()->with(['success' => __('dashboard.the_request_has_been_successfully_cancelled')]);
        }
        return view('admin.orders.show',compact('order'));
    }
}
