<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\User;

class product extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'productID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productID', 'productName', 'productPriceSizeF', 'productPriceSizeS', 'productPriceSizeM','productPriceSizeL', 'productPriceSizeXL',
    'productPriceSize2XL', 'productPriceSize3XL', 'productSold','productSoldMoney', 'productImage','mainProductTypeID','productTypeID'];
    
   
    
}
