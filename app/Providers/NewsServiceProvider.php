<?php

namespace App\Providers;

use App\Models\News;
use App\Repositories\News\NewsRepository;
use App\Services\News\NewsService;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ------------------- IMPORTANTE -------------------
        // -------- INJEÇÃO DE DEPENDENCIA DO SERVICE  --------
        // Aqui é definido o tipo do serviço para ser injetado.
        $this->app->bind(NewsService::class, function ($app) {
            // A injeção das dependencias:
            //     - NewsService.php
            //     - NewsRepository.php
            //     - News.php
            // são feitas por chamada de hierarquia.
            // O provider também deve ser declarado no arquivo:
            // "/bootstrap/app.php"
            return new NewsService(new NewsRepository(new News()));
        });
    }
}
