<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Order extends Model
{
    use SoftDeletes, UploadTrait;

    //TODO: mv consts to consts class
    //! translate consts inside lang files

    const TYPE_BY_USER = 0;
    const TYPE_BY_PROVIDER = 1;

    const STATUS_NEW = 0;
    const STATUS_CANCEL = 3;
    const STATUS_FINISHED_ADMIN = 4;
    const STATUS_INPROGRESS = 5;
    const STATUS_COMPLETE_USER = 6;
    const PAY_TYPE_CASH = 1;
    const PAY_TYPE_CREDIT_CARD = 2;
    const PAY_TYPE_STC = 3;
    const PAY_TYPE_PAY = 4;
    const PAY_STATUS_PENDING = 0;
    const PAY_STATUS_DONE = 2;

    protected $fillable = [
        'order_num', // auto with creating in this boot method
        'type',
        'user_id',
        'provider_id',
        'coupon_id',
        'coupon_num',
        'coupon_type',
        'coupon_value',
        'vat_per',

        'total_products',
        'coupon_amount',
        'vat_amount',
        'deliver_price',
        'final_total',

        'admin_commission_per',
        'admin_commission',

        'status',

        'pay_type',
        'pay_status',
        'pay_data',

        'lat',
        'lng',
        'map_desc',
        'notes',

        'user_delete',
        'provider_delete',
        // 'delegate_delete',
        'admin_delete',
        'education_level_id',
        'university_name',
        'paper_size_id',
        'printing_id',
        'address',
        'cover_id',
        'frame_id',
        'cover_price',
        'frame_price',
        'printing_price',
        'paper_price',
        'total_price',


    ];

    protected $casts = [
        'pay_data' => 'array',
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
    ];

    public function getQrCodeAttribute()
    {
        /**
         * generate image file and store with order id
         * composer require simplesoftwareio/simple-qrcode "~4"
         * https://www.simplesoftware.io/#/docs/simple-qrcode
         */
        if (!Storage::exists("images/qrcodes/$this->id")) {
            QrCode::format('png')->generate("$this->id", base_path() . "/storage/app/public/images/qrcodes/$this->id.png");
        }

        return dashboard_url("storage/images/qrcodes/$this->id.png");
    }

    public function getTypeTextAttribute()
    {
        return trans('order.types_' . $this->type);
    }

    public function getStatusTextAttribute()
    {
        return trans('order.status_' . $this->status);
    }
    public function getStatusConstAttribute()
    {
             return [
                $this::STATUS_NEW => 'STATUS_NEW',
                $this::STATUS_CANCEL => 'STATUS_CANCEL',
                $this::STATUS_INPROGRESS => 'STATUS_INPROGRESS',
                $this::STATUS_FINISHED_ADMIN => 'STATUS_FINISHED_ADMIN',
                $this::STATUS_COMPLETE_USER => 'STATUS_COMPLETE_USER',
             ][$this->status];
    }

    public function getPayTypeTextAttribute()
    {
        return trans('order.pay_type_' . $this->pay_type);
    }

    public function getPayStatusTextAttribute()
    {
        return trans('order.pay_status_' . $this->pay_status);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function offers()
    {
        //return $this->hasMany(Offer::class);
    }

    public function acceptedOffer()
    {
        //return $this->belongsTo(Offer::class, 'accepted_offer_id');
    }

    public static function boot()
    {
        parent::boot();
        $lastId = self::all()->last()->id ?? 0;
        self::creating(function ($model) use ($lastId) {
            $model->order_num = date('Y') . ($lastId + 1);
        });
    }

    public function orderFiles()
    {
        return $this->hasMany(OrderFile::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function paperSize()
    {
        return $this->belongsTo(PaperSize::class);
    }

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }

    public function cover()
    {
        return $this->belongsTo(Cover::class);
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }
}
