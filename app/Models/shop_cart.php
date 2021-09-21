<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class shop_cart extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shop_carts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'shopCartID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['shopCartID', 'priceTotal', 'priceSizeF', 'priceSizeS', 'priceSizeM', 
                            'priceSizeL', 'priceSizeXL', 'priceSize2XL', 'priceSize3XL', 
                            'quanTotal', 'quanSizeF', 'quanSizeS', 'quanSizeM', 'quanSizeL', 'quanSizeXL', 
                            'quanSize2XL', 'quanSize3XL', 'productID', 'memberID', 'materialID'];
    
    
}
