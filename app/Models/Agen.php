<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    protected $table = 'agens';

    protected $primaryKey = 'id_agen';

    protected $fillable = [
        'nama_agen',
        'alamat',
        'telepon',
    ];
}
