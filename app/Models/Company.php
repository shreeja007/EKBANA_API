<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['category_id', 'title', 'image', 'description', 'status'];

    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'category_id');
    }
}
