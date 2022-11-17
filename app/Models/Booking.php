<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','item_id','date_booked','time_booked',
    'quantity','location','units','status'];

    public function users()
    {
     return $this->belongsTo(User::class,'user_id','id');
    }

    public function items()
    {
     return $this->belongsTo(Item::class,'item_id','id');
    }

    public function warehouses()
    {
     return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
}
