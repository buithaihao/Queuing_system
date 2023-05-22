<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'roleid';

    protected $fillable = [
        'rolename',
        'numberuser',
        'describe',
        'Tthietbi',
        'Ctthietbi',
        'Cnthietbi',
        'Tdichvu',
        'Ctdichvu',
        'Cndichvu',
        'Capso',
        'Ctcapso',
        'Tvaitro',
        'Cnvaitro',
        'Ttaikhoan',
        'Cntaikhoan',
    ];

      //Thêm tìm kiếm
      public function scopeSearch($query) {
        $timkiem = request()->timkiem;
    
        if($timkiem) {
            $query = $query->where(function($q) use ($timkiem) {
                $q->where('rolename', 'like', '%'.$timkiem.'%')
                  ->orWhere('numberuser', 'like', '%'.$timkiem.'%')
                  ->orWhere('describe', 'like', '%'.$timkiem.'%');
            });
        }
    
        return $query;
    }
}
