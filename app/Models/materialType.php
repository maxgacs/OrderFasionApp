<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class materialType extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'material_types';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'materialTypeID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['materialTypeID', 'materialTypeName'];
    
    
}
