<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Setor extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $table = 'setores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'sigla',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'usersetores',
            'setor_id',
            'user_id'
        );
    }



}
