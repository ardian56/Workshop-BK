<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'role',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
        'poli',
        'email',
        'password',
    ];

    public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    public function janjiPeriksas()
    {
        return $this->hasMany(JanjiPeriksa::class, 'id_pasien');
    }

      public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
