<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $table = 'diarys';

    protected $primaryKey = 'diaryid';

    protected $fillable = [
        'deviceid',
        'memberid',
        'impacttime',
        'ipdone',
        'thaotac',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'deviceid');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'memberid');
    }

    //Thêm tìm kiếm
    public function scopeSearch($query) {
        $timkiem = request()->timkiem;
    
        if($timkiem) {
            $query = $query->where(function($q) use ($timkiem) {
                $q->where('members.memberlogin', 'like', '%'.$timkiem.'%')
                  ->orWhere('ipdone', 'like', '%'.$timkiem.'%')
                  ->orWhere('thaotac', 'like', '%'.$timkiem.'%');
            });
        }
    
        return $query;
    }
}
