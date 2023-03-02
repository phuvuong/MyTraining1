<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $fillable = [
    	'category_name',
        'category_status'
    ];
 	protected $table = 'categories';
}
