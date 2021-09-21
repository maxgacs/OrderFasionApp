<?php

namespace App\Models;
use Illuminate\Foundation\Auth\member as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class member extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'memberID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['memberID', 'memberName', 'memberStoreName', 'memberUsername', 'memberPassword', 'memberAddress', 'memberPhone', 'memberGender', 'memberImage', 'memberEmail', 'created_at', 'updated_at'];
    
    public static function login($memberUsername,$memberPassword)
    {
        return DB::table('members')
                ->select('*')
                ->where('memberUsername', $memberUsername)
                ->Where('memberPassword', $memberPassword)
                ->first();
    }
}
