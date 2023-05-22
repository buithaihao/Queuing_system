<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $primaryKey = 'imageid';

    protected $fillable = [
        'memberid',
        'image',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberid');
    }
}
