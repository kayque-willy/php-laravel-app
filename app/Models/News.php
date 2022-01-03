<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    // Tabela
   protected $table = 'news';

   // Campos
   protected $fillable = [
       'author_id',
       'title',
       'subtitle',
       'description',
       'published_at',
       'slug'
   ];

   public $timestamps = false;

   // Regras de validação
   public array $rules = [
       'author_id' => 'required|numeric',
       'title' => 'required|min:20|max:100',
       'subtitle' => 'required|min:20|max:155',
       'description' => 'required|min:100'
   ];

   // Relacionamentos
   public function images()
   {
       return $this->hasMany(ImageNews::class, 'news_id', 'id');
   }
}
