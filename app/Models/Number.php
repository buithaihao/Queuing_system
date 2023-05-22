<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    protected $table = 'numbers';

    protected $primaryKey = 'numberid';

    protected $fillable = [
        'deviceid',
        'memberid',
        'membername',
        'memberlogin',
        'password',
        'service',
        'granttime',
        'expiry',
        'trangthai',
        'devicetype',
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
                $q->where('m.membername', 'like', '%'.$timkiem.'%')
                  ->orWhere('numbers.service', 'like', '%'.$timkiem.'%');
            });
        }
    
        return $query;
    }
}
