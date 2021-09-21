<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class payment extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'paymentID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['paymentID', 'payPaid', 'paySlip', 'orderID'];
    
    
}
