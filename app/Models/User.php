<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'name',
        'email',
        'password',
        'role',
        'jenis_kelamin',
        'no_hp',
        'tanggal_lahir',
        'alamat',
        'jabatan',
        'golongan_darah',
        'foto',
        'status_aktif',
    ];

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

    public function insidenDilaporkan()
    {
        return $this->hasMany(Insiden::class, 'dilaporkan_oleh');
    }

    public function insidenDitugaskan()
    {
        return $this->belongsToMany(Insiden::class, 'insiden_user');
    }

    protected function noHp(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                // Hapus semua karakter yang bukan angka (spasi, strip, tanda plus, dll)
                $cleanNumber = preg_replace('/[^0-9]/', '', $value);

                // Jika diawali dengan angka 0, ganti dengan 62
                if (str_starts_with($cleanNumber, '0')) {
                    return '62'.substr($cleanNumber, 1);
                }

                return $cleanNumber;
            }
        );
    }
}
