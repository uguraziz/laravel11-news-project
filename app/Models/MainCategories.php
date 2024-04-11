<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
    use HasFactory;
    protected $table = 'main_categories';
    protected $fillable = [
        'name',
        'slug',
        'image_id',
    ];
}
