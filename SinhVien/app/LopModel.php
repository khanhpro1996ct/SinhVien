<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LopModel extends Model
{
    protected $table = 'lop';
    protected $primarykey = 'id';
    protected $keyType = 'varchar';
    protected $fillable = [
        'id', 'name', 'parent_nganh', 'parent_khoa',
    ];
}
