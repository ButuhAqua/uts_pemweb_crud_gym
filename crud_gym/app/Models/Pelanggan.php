<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'tempat',
        'tanggal_lahir',
        'jenis_kelamin',
        'nomor',
        'paket',
    ];

    public const jenis_kelamin = [
        'laki-laki' => 'Laki-laki',
        'perempuan' => 'Perempuan',
    ];

    public const paket = [
        'paket_1' => '1 Bulan',
        'paket_2' => '3 Bulan',
        'paket_3' => '5 Bulan',
    ];
}
