<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    /**
     * Mengizinkan Laravel untuk melakukan Mass Assignment (menyimpan banyak data sekaligus).
     * Kolom-kolom di bawah ini wajib didaftarkan agar tidak terkena error "MassAssignmentException".
     */
    protected $fillable = [
        'school_name',
        'headmaster_name',
        'headmaster_photo',
        'headmaster_welcome',
        'vision',
        'mission',
        'history',
        'address',
        'phone',
        'email',
    ];
}