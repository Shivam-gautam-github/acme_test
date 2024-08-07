<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['id','product_name','price','actual_price','slug','title','tags','product_overview','product_desc','instruction','delivery_and_installation','warranty','faqs','disclaimer','terms_condtion','image','images','video','created_at','updated_at'];

}
