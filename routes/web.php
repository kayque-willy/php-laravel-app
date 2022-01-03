<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\ImageNews\ImageNewsController;
// use App\Http\Middleware\ValidateDataMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// --------------------------- ROTAS APP ---------------------------
Route::get('/', [NewsController::class, 'index']);
// Exibição das paginas
Route::get('/newsApp', [NewsController::class, 'showCreateNewsPage']);
Route::get('/newsApp/{id}', [NewsController::class, 'showNewsPage']);
Route::get('/editNewsApp/{id}', [NewsController::class, 'showEditNewsPage']);
// Metodos CRUD
Route::post('/newsApp', [NewsController::class, 'createNews']);
Route::put('/editNewsApp/{id}', [NewsController::class, 'editNews']);
Route::delete('/', [NewsController::class, 'deleteNews']);


// ----------------------- ROTAS IMPORTAS DA API ----------------------
// --------------------------- ROTAS AUTHOR ---------------------------
// // Index
// // Route::get('/', [AuthorController::class, 'index']);
// // Criar autor
// Route::post('/author', [AuthorController::class, 'create']);
// // Listar autores
// Route::get('/author', [AuthorController::class, 'findAll']);
// // Recuperar autor por id
// Route::get('/author/{id}', [AuthorController::class, 'findOneBy']);
// // Atualizar autor por parametro
// Route::put('/author/{param}', [AuthorController::class, 'editBy']);
// // Remover autor
// Route::delete('/author/{id}', [AuthorController::class, 'delete']);

// // --------------------------- ROTAS NOTICIAS ---------------------------
// // Criar noticia
// Route::post('/news', [NewsController::class, 'create']);
// // Listar noticias
// Route::get('/news', [NewsController::class, 'findAll']);
// // Encontrar noticias pelo ID do autor
// Route::get('/news/author/{author_id}', [NewsController::class, 'findByAuthor']);
// // Encontrar noticias por parametro
// Route::get('/news/{param}', [NewsController::class, 'findBy']);
// // Atualizar noticia
// Route::put('/news/{param', [NewsController::class, 'editBy']);
// // Remover noticia por parametro
// Route::delete('/news/{param', [NewsController::class, 'deleteBy']);
// // Remover noticia por ID do autor
// Route::delete('/news/author/{author_id}', [NewsController::class, 'deleteByAuthor']);

// // --------------------------- ROTAS IMAGEM ---------------------------
// // Criar imagem da noticia
// Route::post('/image-news', [ImageNewsController::class, 'create']);
// // Listar todas as imagens
// Route::get('/image-news', [ImageNewsController::class, 'findAll']);
// // Recuperar imagens pelo ID da noticia
// Route::get('/image-news/news/{news_id}', [ImageNewsController::class, 'findByNews']);
// // Recuperar imagem pelo ID
// Route::get('/image-news/{id}', [ImageNewsController::class, 'findOneBy']);
// // Atualizar imagem
// Route::put('/image-news/{param}', [ImageNewsController::class, 'editBy']);
// // Remover imagem pelo ID da noticia
// Route::delete('/image-news/news/{news_id}', [ImageNewsController::class, 'deleteByNews']);
// // Remover imagem por ID
// Route::delete('/image-news/{id}', [ImageNewsController::class, 'delete']);

// Rotas com Middleware
// Route::middleware(['ValidateDataMiddleware','Authenticate'])->group(function () {
//     // Criar autor
//     Route::post('/author', [AuthorController::class, 'create']);

//     // Criar noticia
//     Route::post('/news', [NewsController::class, 'create']);
// });
