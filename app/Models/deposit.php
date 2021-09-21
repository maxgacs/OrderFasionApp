<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class deposit extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deposits';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'DepositID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['DepositID', 'depositPaid', 'depositSlip', 'orderID'];
    
    
}
