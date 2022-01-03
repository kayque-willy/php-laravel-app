<?php

namespace App\Http\Controllers\News;

use App\Helpers\OrderByHelper;
use App\Http\Controllers\AbstractController;
use App\Services\News\NewsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends AbstractController
{
    protected array $searchFields = [
        'title',
        'slug',
        'subtitle'
    ];

    // ------------------- IMPORTANTE -------------------
    // -------- INJEÇÃO DE DEPENDENCIA DO SERVICE  --------
    // Aqui é definido o tipo do serviço para ser injetado.
    public function __construct(NewsService $service)
    {
        // A injeção das dependencias:
        //     - NewsService.php
        //     - NewsRepository.php
        //     - News.php
        // são feitas por chamada de hierarquia no arquivo
        // "app/providers/AuthorServiceProvider.php"
        // O provider também deve ser declarado no arquivo:
        // "/bootstrap/app.php"
        parent::__construct($service);
    }

    // ------------------- Metodos do APP -------------------
    public function index(Request $request)
    {
        return $this->newsListPage($request);
    }

    // ----------------- Página de listagem de notícias -----------------
    public function newsListPage(Request $request)
    {
        try {
            $limit = (int) $request->get('limit', 10);
            $orderBy = $request->get('order_by', []);

            if (!empty($orderBy)) {
                $orderBy = OrderByHelper::treatOrderBy($orderBy);
            }

            $searchString = $request->get('q', '');

            if (!empty($searchString)) {
                $result = $this->service->searchBy(
                    $searchString,
                    $this->searchFields,
                    $limit,
                    $orderBy
                );
            } else {
                $result = $this->service->findAll($limit, $orderBy);
            }
            return view('post-list')
                ->with('data', $result['data'])
                ->with('current_page', $result['current_page'])
                ->with('from', $result['from'])
                ->with('last_page', $result['last_page'])
                ->with('first_page_url', $result['first_page_url'])
                ->with('prev_page_url', $result['prev_page_url'])
                ->with('next_page_url', $result['next_page_url'])
                ->with('last_page_url', $result['last_page_url'])
                ->with('links', $result['links'])
                ->with('path', $result['path'])
                ->with('per_page', $result['per_page'])
                ->with('to', $result['to'])
                ->with('total', $result['total']);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }


    // ----------------- Pagina de visualização da noticia -----------------
    public function showNewsPage(Request $request, int $id)
    {
        try {
            $result = $this->service->findOneBy($id);
            return view('post')->with('post', $result);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    // ----------------- Pagina de criação da noticia -----------------
    public function showCreateNewsPage()
    {
        return view('new-post');
    }

    // ----------------- Pagina de edição da noticia -----------------
    public function showEditNewsPage(Request $request, int $id)
    {
        try {
            $result = $this->service->findOneBy($id);
            return view('edit-post')->with('news', $result);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    // ----------------- Criar nova a noticia -----------------
    public function createNews(Request $request)
    {
        try {
            $data = $request->all();
            $data['published_at'] = date('Y-m-d H:i:s');
            $this->service->create($data);
            return $this->newsListPage($request);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    // ----------------- Editar noticia -----------------
    public function editNews(Request $request, string $param)
    {
        try {
            $data = $request->all();
            $data['published_at'] = date('Y-m-d H:i:s');
            $this->service->editBy($param, $data);
            return $this->newsListPage($request);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    // ----------------- Remover noticia -----------------
    public function deleteNews(Request $request)
    {
        $id = $request->get('id');
        try {
            $result['registro_deletado'] = $this->service->delete($id);
            return $this->newsListPage($request);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    // ------------------- Metodos importados da API -------------------
    // public function findByAuthor(Request $request, int $author_id): JsonResponse
    // {
    //     try {
    //         $limit = (int) $request->get('limit', 10);
    //         $orderBy = $request->get('order_by', []);

    //         if (!empty($orderBy)) {
    //             $orderBy = OrderByHelper::treatOrderBy($orderBy);
    //         }

    //         $result = $this->service->findByAuthor($author_id, $limit, $orderBy);

    //         $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
    //     } catch (Exception $e) {
    //         $response = $this->errorResponse($e);
    //     }

    //     return response()->json($response, $response['status_code']);
    // }


    // public function findBy(Request $request, string $param): JsonResponse
    // {
    //     try {
    //         $result = $this->service->findBy($param);
    //         $response = $this->successResponse($result);
    //     } catch (Exception $e) {
    //         $response = $this->errorResponse($e);
    //     }

    //     return response()->json($response, $response['status_code']);
    // }


    // public function deleteBy(Request $request, string $param): JsonResponse
    // {
    //     try {
    //         $result['deletado'] = $this->service->deleteBy($param);
    //         $response = $this->successResponse($result);
    //     } catch (Exception $e) {
    //         $response = $this->errorResponse($e);
    //     }

    //     return response()->json($response, $response['status_code']);
    // }


    // public function deleteByAuthor(Request $request, int $author_id): JsonResponse
    // {
    //     try {
    //         $result['deletado'] = $this->service->deleteByAuthor($author_id);
    //         $response = $this->successResponse($result);
    //     } catch (Exception $e) {
    //         $response = $this->errorResponse($e);
    //     }

    //     return response()->json($response, $response['status_code']);
    // }
}
