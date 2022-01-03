<?php

namespace App\Http\Controllers;

use App\Helpers\OrderByHelper;
use App\Services\ServiceInterface;
use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AbstractController extends Controller implements ControllerInterface
{

    protected ServiceInterface $service;
    protected array $searchFields = [];

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->make('<h1>Exemplo de API PHP REST</h1><span>PHP Lumen, Eloquent e PostgreSQL.</span>'
        . '<hr><table> <thead> <tr> <th>ROTA</th> <th>HTTP(Verbo)</th> <th>Request</th> <th>Return</th> <th>Description</th> </tr> </thead> <tbody> <tr> <td>/api/</td> <td>GET</td> <td>-</td> <td>HTML</td> <td>API index</td> </tr> <tr> <td>/api/author</td> <td>GET</td> <td>-</td> <td>JSON</td> <td>List author</td> </tr> <tr> <td>/api/author</td> <td>POST</td> <td>JSON</td> <td>JSON</td> <td>Create author</td> </tr> <tr> <td>/api/author/{id}</td> <td>GET</td> <td>int(id)</td> <td>JSON</td> <td>Get author by id</td> </tr> <tr> <td>/api/author/{param}</td> <td>PUT</td> <td>JSON, param</td> <td>JSON</td> <td>Update author by param</td> </tr> <tr> <td>/api/author/{id}</td> <td>DELETE</td> <td>JSON, int(id)</td> <td>boolean</td> <td>Delete author by id</td> </tr> <tr> <td>/api/news</td> <td>GET</td> <td>-</td> <td>JSON</td> <td>List news</td> </tr> <tr> <td>/api/news</td> <td>POST</td> <td>JSON</td> <td>JSON</td> <td>Create news</td> </tr> <tr> <td>/api/news/{param}</td> <td>GET</td> <td>param</td> <td>JSON</td> <td>List news by param</td> </tr> <tr> <td>/api/news/{param}</td> <td>PUT</td> <td>JSON, param</td> <td>JSON</td> <td>Update news by param</td> </tr> <tr> <td>/api/news/{param}</td> <td>DELETE</td> <td>JSON, param</td> <td>boolean</td> <td>Delete news by param</td> </tr> <tr> <td>/api/news/author/{author_id}</td> <td>GET</td> <td>JSON, int(author_id)</td> <td>JSON</td> <td>Get news by author id</td> </tr> <tr> <td>/api/news/author/{author_id}</td> <td>DELETE</td> <td>JSON, int(author_id)</td> <td>boolean</td> <td>Delete news by author id</td> </tr> <tr> <td>/api/image-news</td> <td>GET</td> <td>-</td> <td>JSON</td> <td>List image news</td> </tr> <tr> <td>/api/image-news</td> <td>POST</td> <td>JSON</td> <td>JSON</td> <td>Create image news</td> </tr> <tr> <td>/api/image-news/{id}</td> <td>GET</td> <td>JSON, int(id)</td> <td>JSON</td> <td>Get image  by  id</td> </tr> <tr> <td>/api/image-news/{id}</td> <td>DELETE</td> <td>JSON, int(id)</td> <td>boolean</td> <td>Delete image by param</td> </tr> <tr> <td>/api/image-news/{param}</td> <td>PUT</td> <td>JSON, param</td> <td>JSON</td> <td>Update image by param</td> </tr> <tr> <td>/api/image-news/news/{news_id}</td> <td>GET</td> <td>int(news_id)</td> <td>JSON</td> <td>List image by news id</td> </tr> <tr> <td>/api/image-news/news/{news_id}</td> <td>DELETE</td> <td>JSON, int(news_id)</td> <td>boolean</td> <td>Delete image by news id</td> </tr> </tbody> </table>');
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $result = $this->service->create($request->all());
            $response = $this->successResponse($result, Response::HTTP_CREATED);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        return response()->json($response, $response['status_code']);
    }

    public function findAll(Request $request): JsonResponse
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

            $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        return response()->json($response, $response['status_code']);
    }

    public function findOneBy(Request $request, int $id): JsonResponse
    {
        try {
            $result = $this->service->findOneBy($id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        return response()->json($response, $response['status_code']);
    }

    public function editBy(Request $request, string $param): JsonResponse
    {
        try {
            $result['registro_alterado'] = $this->service->editBy($param, $request->all());
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        return response()->json($response, $response['status_code']);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        try {
            $result['registro_deletado'] = $this->service->delete($id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        return response()->json($response, $response['status_code']);
    }

    protected function successResponse(array $data, int $statusCode = Response::HTTP_OK): array
    {
        return [
            'status_code' => $statusCode,
            'data' => $data
        ];
    }

    protected function errorResponse(Exception $e, int $statuCode = Response::HTTP_BAD_REQUEST): array
    {
        return [
            'status_code' => $statuCode,
            'error' => true,
            'error_description' => $e->getMessage()
        ];
    }
}
