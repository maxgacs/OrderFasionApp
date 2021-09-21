<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class material extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materials';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'materialID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['materialID', 'materialName', 'materialColor', 'materialPrice','materialSize','materialImage','cutRate','materialTypeID'];
    
    
}
