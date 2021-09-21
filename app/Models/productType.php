<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class productType extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_types';

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
    protected $fillable = ['productTypeID', 'typeName', 'sizeRateF', 'sizeRateS', 'sizeRateM', 
                            'sizeRateL', 'sizeRateXL', 'sizeRate2XL', 'sizeRate3XL', 'mainProductTypeID', 'patternRate'];
    
    
}
