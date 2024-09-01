<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'saved',
        'user_id',
        'item_id',
        'quantity',
        'address',
        'post_code',
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
