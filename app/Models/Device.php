<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $primaryKey = 'deviceid';

    protected $fillable = [
        'memberid',
        'devicecode',
        'devicetype',
        'devicename',
        'ipaddress',
        'service',
        'tinhtrang',
        'ketnoi',
        'memberlogin',
        'password',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberid');
    }

    //Thêm tìm kiếm
    public function scopeSearch($query) {
        $timkiem = request()->timkiem;
    
        if($timkiem) {
            $query = $query->where(function($q) use ($timkiem) {
                $q->where('devicename', 'like', '%'.$timkiem.'%')
                  ->orWhere('devicecode', 'like', '%'.$timkiem.'%')
                  ->orWhere('ipaddress', 'like', '%'.$timkiem.'%')
                  ->orWhere('service', 'like', '%'.$timkiem.'%')
                  ->orWhere('members.membername', 'like', '%'.$timkiem.'%')
                  ->orWhere('members.memberlogin', 'like', '%'.$timkiem.'%');
            });
        }
    
        return $query;
    }

    public function scopeUser($query)
    {
        if ($user = session('user')) {
            return $query->where('memberid', $user->memberid);
        }

        return null;
        
    }

}


