<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Sofa\Eloquence\Eloquence; // base trait
use Sofa\Eloquence\Mappable; // extension trait


class User extends Model
{

    use Eloquence, Mappable;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'country',
        'ip',
        'imei',
        'phone',
        'device',
        'uniq_id',
        'login_at'           
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'device',
        'imei',
        'ip',
        'id',
        'uniq_id'
    ];

    protected $maps = [
        'uid'=>'id',
        'invitationCode'=>'uniq_id'
    ];

    protected $appends = ['uid','invitationCode'];
    
    public function flags()
    {
        return $this->hasOne('App\UserFlags');
    }

    public function balance()
    {
        return $this->hasOne('App\Balance');
    }

    public function token()
    {
        return $this->hasOne('App\models\Tokens');
    }

    public function friends()
    {
        return $this->hasMany('App\models\FriendList');
    }

    public function support()
    {
        return $this->hasMany('App\models\Support');
    }

    public function redeemRequests()
    {
        return $this->hasMany('App\models\RedeemRequest');
    }

    public function creditHistory()
    {
        return $this->hasMany('App\models\Credithistory');
    }    
}
