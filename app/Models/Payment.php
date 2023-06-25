<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'orderdetail_id',
        'nama',
        'bankasal',
        'banktujuan',
        'image'
    ];

    public function OrderDetail(){
        return $this->belongsTo(OrderDetail::class,'orderdetail_id');
    }
}
