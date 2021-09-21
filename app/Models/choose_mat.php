<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class choose_mat extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'choose_mat';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'choose_matID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['choose_matID', 'productID', 'materialID'];
    
    
}
