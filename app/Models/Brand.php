<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
    	'brand_name',
        'brand_status'
    ];
    protected $table = 'brands';

}
