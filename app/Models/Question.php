<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'question_name',
        'question_description',
        'category_id',
        'sub_category_id',
        'question_short_description',
        'question_image',
        'question_type',
        'admin_id',
        'is_active',
        'image_type',
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id','id');
    }

    
}
