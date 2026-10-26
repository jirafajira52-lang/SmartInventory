<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributors';

    protected $primaryKey = 'id_distributor';

    protected $fillable = [
        'nama_distributor',
        'alamat',
        'telepon',
        'email',
    ];
}
