<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'link', 'deskripsi', 'profile_siswa_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function profile_siswa()
    {
        return $this->belongsTo(ProfileSiswa::class, 'profile_siswa_id');
    }
}
