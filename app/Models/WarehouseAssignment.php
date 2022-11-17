<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseAssignment extends Model
{
    use HasFactory;
    protected $fillable=['booking_id','warehouse_id','user_id','item_id',
    'charge_plan','check_in_date','check_out_date',
    'total_charge','no_days','is_checked_out'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');

    }

    public function bookings()
    {
        return $this->belongsTo(Booking::class,'booking_id','id');

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
