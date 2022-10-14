<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['item_name','brand_id','slug','description','unit'];

    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    
    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
