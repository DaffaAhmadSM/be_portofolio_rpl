<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];
    protected $hidden = ['created_at', 'updated_at'];

    public function profile_siswa()
    {
        return $this->hasMany(ProfileSiswa::class, 'divisi_id');
    }
}
