<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public $soratble = ['total'];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

}
