<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaModel extends Model
{
    protected $table = 'khoa';
    protected $primarykey = 'id';
    protected $keyType = 'varchar';
    protected $fillable = [
        'id', 'name',
    ];
}
