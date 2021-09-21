<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class mainProductType extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'main_product_types';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'mainProductTypeID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['mainProductTypeID', 'mainProductTypeName', 'mainProductTypeImage'];	
    
    
}
