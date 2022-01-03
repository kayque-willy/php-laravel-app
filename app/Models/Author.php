<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;


class Author extends Model
{
    use HasFactory;

    // Tabela
    protected $table = 'author';

    // Campos
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'gender',
        'active'
    ];

    // Campos ocultos
    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    // Regras de validação
    public array $rules = [
        'name' => 'required|min:2|max:45|alpha',
        'lastname' => 'required|min:2|max:60|alpha',
        'email' => 'required|email|max:100|email:rfc,dns',
        'password' => 'required|between:6,12',
        'gender' => 'required|alpha|max:1'
    ];

    // Relacionamentos
    public function news()
    {
        return $this->hasMany(News::class);
    }
}