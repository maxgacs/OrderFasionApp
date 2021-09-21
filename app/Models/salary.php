<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class salary extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salary';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'salaryID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['salaryID', 'Salary', 'statusOrder', 'startDate', 'endDate','endDateReal', 'statusSalary','imageSalary',
    'quanSizeF','quanSizeS','quanSizeM','quanSizeL','quanSizeXL','quanSize2XL','quanSize3XL', 'empID', 'orderID'];
    
    
}
