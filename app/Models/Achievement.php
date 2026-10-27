<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    
protected $fillable = ['title',          // Judul / Nama Lomba
        'student_name',   // Nama Siswa (Kolom ini yang menyebabkan error)
        'competition_name',       // misal: Akademik / Non-Akademik
        'level',    // Deskripsi Prestasi
        'photo',];
}
