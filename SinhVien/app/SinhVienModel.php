<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhVienModel extends Model
{
    protected $table = 'sinhvien';
    protected $primarykey = 'id';
    protected $keyType = 'varchar';
    protected $fillable = [
        'id', 'mssv', 'isquanly', 'name', 'gioitinh', 'lop', 'khoa', 'nganh', 'email', 'sdt', 'anh', 'password'
    ];
}
