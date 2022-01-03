<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageNews extends Model
{
    use HasFactory;
    // Tabela
    protected $table = 'image_news';

    // Campos
    protected $fillable = [
        'news_id',
        'image',
        'description',
        'active',
        'created_at',
    ];

    public $timestamps = false;

    // Regras de validação
    public array $rules = [
        'news_id' => 'required|numeric',
        'image' => 'required',
        'description' => 'required|min:10|max:255'
    ];
}
