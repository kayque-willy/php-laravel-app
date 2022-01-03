<?php

namespace App\Providers;

use App\Models\Author;
use App\Repositories\Author\AuthorRepository;
use App\Services\Author\AuthorService;
use Illuminate\Support\ServiceProvider;

class AuthorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ------------------- IMPORTANTE -------------------
        // -------- INJEÇÃO DE DEPENDENCIA DO SERVICE  --------
        // Aqui é definido o tipo do serviço para ser injetado.
        $this->app->bind(AuthorService::class, function ($app) {
            // A injeção das dependencias:
            //     - AuthorService.php
            //     - AuthorRepository.php
            //     - Author.php
            // são feitas por chamada de hierarquia.
            // O provider também deve ser declarado no arquivo:
            // "/bootstrap/app.php"
            return new AuthorService(new AuthorRepository(new Author()));
        });
    }
}
