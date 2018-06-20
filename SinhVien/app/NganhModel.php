<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NganhModel extends Model
{
    protected $table = 'nganh';
    protected $primarykey = 'id';
    protected $keyType = 'varchar';
    protected $fillable = [
        'id', 'name', 'parent',
    ];
}
