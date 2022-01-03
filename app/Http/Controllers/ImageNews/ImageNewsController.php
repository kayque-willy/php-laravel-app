<?php

namespace App\Http\Controllers\ImageNews;

use App\Http\Controllers\AbstractController;
use App\Services\ImageNews\ImageNewsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageNewsController extends AbstractController
{
    protected array $searchFields = [];

    // ------------------- IMPORTANTE -------------------
    // -------- INJEÇÃO DE DEPENDENCIA DO SERVICE  --------
    // Aqui é definido o tipo do serviço para ser injetado.
    public function __construct(ImageNewsService $service)
    {
        // A injeção das dependencias:
        //     - ImageNewsService.php
        //     - ImageNewsRepository.php
        //     - ImageNews.php
        // são feitas por chamada de hierarquia no arquivo
        // "app/providers/AuthorServiceProvider.php"
        // O provider também deve ser declarado no arquivo:
        // "/bootstrap/app.php"
        parent::__construct($service);
    }

    public function findByNews(Request $request, int $news_id): JsonResponse
    {
        try {
            $result = $this->service->findByNews($news_id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    public function deleteByNews(Request $request, int $news_id): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteByNews($news_id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
