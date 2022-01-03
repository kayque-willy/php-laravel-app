<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\AbstractController;
use App\Services\Author\AuthorService;

class AuthorController extends AbstractController
{
    protected array $searchFields = [
        'nome',
        'sobrenome'
    ];

    // ------------------- IMPORTANTE -------------------
    // -------- INJEÇÃO DE DEPENDENCIA DO SERVICE  --------
    // Aqui é definido o tipo do serviço para ser injetado.
    public function __construct(AuthorService $service)
    {
        // A injeção das dependencias:
        //     - AuthorService.php
        //     - AuthorRepository.php
        //     - Author.php
        // são feitas por chamada de hierarquia no arquivo:
        // "app/providers/AuthorServiceProvider.php"
        // O provider também deve ser declarado no arquivo:
        // "/bootstrap/app.php"
        parent::__construct($service);
    }

}
