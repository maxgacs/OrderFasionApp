<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class employeeType extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_types';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'empTypeID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['empTypeID', 'nameEmpType', 'nameJob'];
    
    
}
