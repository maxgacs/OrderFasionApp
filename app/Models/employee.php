<?php

namespace App\Models;
use Illuminate\Foundation\Auth\employee as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class employee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'empID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['empID', 'empName', 'empAddress', 'empEmail', 'empPhone', 'empGender', 'empImage', 
    'empUsername', 'empPassword', 'empStat', 'empStatus', 'bankCode', 'bankID', 'empTypeID', 'created_at', 'updated_at'];
    
    public static function login($empUsername,$empPassword)
    {
        return DB::table('employees')
                ->select('*')
                ->where('empUsername', $empUsername)
                ->Where('empPassword', $empPassword)
                ->first();
    }
}
