<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'dictionary_name',
        'dictionary_description',
        'category_id',
        'sub_category_id',
        'dictionary_version',
        'dictionary_type',
        'admin_id',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function description()
    {
        return $this->hasMany('App\Models\Description','dictionary_id','id');
    }
}
