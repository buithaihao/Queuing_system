<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'serviceid';

    protected $fillable = [
        'servicecode',
        'memberid',
        'membername',
        'deviceid',
        'servicename',
        'describe',
        'granttime',
        'autoincrease',
        'prefix',
        'surfix',
        'reset',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberid');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'deviceid');
    }

    //Thêm tìm kiếm
    public function scopeSearch($query) {
        $timkiem = request()->timkiem;
    
        if($timkiem) {
            $query = $query->where(function($q) use ($timkiem) {
                $q->where('servicecode', 'like', '%'.$timkiem.'%')
                  ->orWhere('servicename', 'like', '%'.$timkiem.'%')
                  ->orWhere('describe', 'like', '%'.$timkiem.'%')
                  ->orWhere('devices.membername', 'like', '%'.$timkiem.'%')
                  ->orWhere('devices.memberlogin', 'like', '%'.$timkiem.'%');
            });
        }
    
        return $query;
    }
}
