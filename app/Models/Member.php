<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model implements Authenticatable
{
    public $timestamps = false;
    
    use HasFactory;

    protected $table = 'members';
    protected $primaryKey = 'memberid';
    protected $fillable = [
        'memberid',
        'membername',
        'memberlogin',
        'tel',
        'password',
        'membertoken',
        'email',
        'tinhtrang',
        'vaitro',
    ];
    public function getAuthIdentifierName()
    {
        return 'memberlogin';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
      
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

     //Thêm tìm kiếm
     public function scopeSearch($query) {
        $timkiem = request()->timkiem;
    
        if($timkiem) {
            $query = $query->where(function($q) use ($timkiem) {
                $q->where('membername', 'like', '%'.$timkiem.'%')
                  ->orWhere('memberlogin', 'like', '%'.$timkiem.'%')
                  ->orWhere('tel', 'like', '%'.$timkiem.'%')
                  ->orWhere('email', 'like', '%'.$timkiem.'%')
                  ->orWhere('vaitro', 'like', '%'.$timkiem.'%');
            });
        }
    
        return $query;
    }

    //Thêm localScope
    public function scopeOrderby($query) 
    {
        if($tenvaitro = request()->tenvaitro) {
            $query = $query->where('vaitro', $tenvaitro);
        }
    
        return $query;
    }

    // public static function user() {
    //     return self::find(session('user')->memberid);
    // }

    public static function user()
    {
        if ($user = session('user')) {
            return self::find(session('user')->memberid);
        }

        return null;
    }
    

}