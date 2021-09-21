<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class order_detail extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'orderDetailID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['orderDetailID', 'priceTotal', 'priceSizeF', 'priceSizeS', 'priceSizeM', 
                            'priceSizeL', 'priceSizeXL', 'priceSize2XL', 'priceSize3XL',
                            'quanTotal', 'quanSizeF', 'quanSizeS', 'quanSizeM', 'quanSizeL', 'quanSizeXL', 
                            'quanSize2XL', 'quanSize3XL', 'productID', 'orderID','created_at'];	
                            
                            
}
