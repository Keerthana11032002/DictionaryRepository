<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'description_language',
        'translate_category_id',
        'category_id',
        'dictionary_id',
    ];
    public function dictionary()
    {
        return $this->belongsTo('App\Models\Dictionary','dictionary_id','id');
    }

    
}
