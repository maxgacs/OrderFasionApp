<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class order extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'orderID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['orderID', 'overdueMoney', 'stepStatusID','memberID','text_alert','text_alertStatus','imageCompensation', 'dateline','created_at'];
    
    
}
