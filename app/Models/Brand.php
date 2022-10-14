<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','category_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
