<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'link', 'deskripsi', 'profile_siswa_id', 'divisi_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
