<?php

namespace App\Providers;

use App\Models\ImageNews;
use App\Repositories\ImageNews\ImageNewsRepository;
use App\Services\ImageNews\ImageNewsService;
use Illuminate\Support\ServiceProvider;

class ImageNewsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ------------------- IMPORTANTE -------------------
        // -------- INJEÇÃO DE DEPENDENCIA DO SERVICE  --------
        // Aqui é definido o tipo do serviço para ser injetado.
        $this->app->bind(ImageNewsService::class, function ($app) {
            // A injeção das dependencias:
            //     - ImageNewsService.php
            //     - ImageNewsRepository.php
            //     - ImageNews.php
            // são feitas por chamada de hierarquia.
            // O provider também deve ser declarado no arquivo:
            // "/bootstrap/app.php"
            return new ImageNewsService(new ImageNewsRepository(new ImageNews()));
        });
    }
}
