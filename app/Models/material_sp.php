<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class material_sp extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'material_sps';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'material_spID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['material_spID', 'material_spName', 'material_spPrice', 'material_spQuan', 'material_spSize'];	
    
    
}
