<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\MyOrdersRequest;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Resources\Api\MyOrderResource;
use App\Http\Resources\Api\OrderDetailsResource;
use App\Models\Admin;
use App\Models\Cover;
use App\Models\Frame;
use App\Models\Order;
use App\Models\PaperSize;
use App\Models\Printing;
use App\Models\User;
use App\Notifications\Orders\NewOrderNotify;
use App\Notifications\Orders\AdminNotify;
use App\Notifications\Orders\AcceptNotify;
use App\Notifications\Orders\InProgressNotify;
use App\Traits\Firebase;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    use ResponseTrait, Firebase;


    public function storeOrder(OrderRequest $request)
    {
//        dd($request->validated());
        $order = Order::create($request->validated());

        if (isset($request->files)) {
            $this->storeOrderFiles($order, $request->file('files'));
        }
        $this->getOrderPricesArr($request, $order);

        Notification::send($order->user, new AcceptNotify($order));

        $superAdmin = Admin::find(1);
        Notification::send($superAdmin, new NewOrderNotify($order));
        return $this->successMsg(__('apis.order_stored'));
    }

    public function countPages($path)
    {
        $pdftext = file_get_contents($path);
        $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        return $num;
    }

    public function getOrderPricesArr($request, $order)
    {
//        dd($request->printing_id);
        $pagesCount = 0;
        foreach ($order->orderFiles as $file) {
            $file_type = explode("/", $file->type);
//            dd($file->type->count());
            if ($file_type[0] == 'image') {
                $pagesCount = $pagesCount + 1;
            } else {
                $pagesCount = $pagesCount + $this->countPages($file->file);
            }
        }
        $paper_size = PaperSize::find($request->paper_size_id);
        $printing = Printing::find($request->printing_id);

        if ($request->cover_id){
            $cover = Cover::find($request->cover_id)->price;
        }else{
            $cover = 0;
        }
//        dd($cover);
//        $frame_price = 0;
//        if ($request->frame_id) {
//            $frame = Frame::find($request->frame_id);
//            $frame_price = $frame->price;
//        }
//        dd($request->cover_id);

        $total_price = ($paper_size->price + $printing->price ) * $pagesCount +($cover);
        $order->update([
            'cover_price' => $cover,
//            'frame_price' => $frame_price,
            'printing_price' => $printing->price,
            'paper_price' => $paper_size->price,
            'total_price' => $total_price,
            'frame_id' => $request->frame_id,
        ]);

        return;
    }

    private function storeOrderFiles($order, $files)
    {
        foreach ($files as $file) {
            $order->orderFiles()->create(['file' => $file]);
        }
    }

    public function orderDetails(Order $order)
    {
        $user_orders_ids = auth()->user()->orders()->pluck('id')->toArray();
        if (in_array($order->id, $user_orders_ids)) {
            return $this->successData(['order' => new OrderDetailsResource($order)]);
        } else {
            return $this->response('fail', __('apis.no_orders_yet'));
        }
    }

    public function orderConfirm(Order $order)
    {
        if($order->status == 0){
            return $this->response('fail', __('apis.the_order_cannot_be_confirmed_now_because_the_order_is_new'));
        }

        if($order->status == 5){
            return $this->response('fail', __('apis.the_order_cannot_be_confirmed_now_because_the_order_is_inprogress'));
        }
        $order->update(['status' => Order::STATUS_COMPLETE_USER]);

        return $this->response('success', __('apis.receipt_confirmed_successfully'));
    }

    public function orderCancel(Order $order)
    {
        if($order->status == 5){
            return $this->response('fail', __('apis.the_request_cannot_be_canceled_because_it_is_in_progress'));
        }

        if($order->status == 4 || $order->status == 6){
            return $this->response('fail', __('apis.the_order_cannot_be_canceled_because_it_has_been_completed'));
        }
        $order->update(['status' => Order::STATUS_CANCEL]);
        return $this->response('success', __('apis.the_order_has_been_successfully_cancelled'));
    }

    public function myOrders(MyOrdersRequest $request)
    {
        $myOrders = auth()->user()->orders->where('status', $request->status);
        return $this->successData(['orders' => MyOrderResource::collection($myOrders)]);
    }

    public function myCurrentOrders(Request $request)
    {
        $myOrders = auth()->user()->orders()->orderBy('created_at','desc')->where('status', Order::STATUS_NEW)->paginate($this->paginateNum());
        return $this->successData(['orders' => MyOrderResource::collection($myOrders)]);
    }

    public function myInProgressOrders(Request $request)
    {
        $myOrders = auth()->user()->orders()->orderBy('created_at','desc')->whereIn('status',[Order::STATUS_INPROGRESS,Order::STATUS_FINISHED_ADMIN])->paginate($this->paginateNum());
        return $this->successData(['orders' => MyOrderResource::collection($myOrders)]);
    }

    public function myFinishedOrders(Request $request)
    {
        $myOrders = auth()->user()->orders()->orderBy('created_at','desc')->where('status', Order::STATUS_COMPLETE_USER)->paginate($this->paginateNum());
        return $this->successData(['orders' => MyOrderResource::collection($myOrders)]);
    }

}
