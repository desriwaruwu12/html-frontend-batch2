<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virtualtour extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $table= 'Virtualtour';
    protected $primaryKey= 'id';
    protected $fillable = [
        'paket',
        'harga',
        'tanggal_pelaksanaan',
        'url_gambar'
    ];
}