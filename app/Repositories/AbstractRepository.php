<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data): array
    {
        return $this->model::create($data)->toArray();
    }

    public function findAll(int $limit = 10, array $orderBy = []): array
    {
        $results = $this->model::query();
        
        // Tratamento do order by
        $results = $this->resolveOrderBy($orderBy, $results);

        // Retorna os resultados com paginação
        return $results
            ->paginate($limit)
            ->appends([
                'order_by' => implode(',', array_keys($orderBy)),
                'limit' => $limit
            ])->toArray();
    }

    public function findOneBy(int $id): array
    {
        return $this->model::findOrFail($id)->toArray();
    }

    public function editBy(string $param, array $data): bool
    {
        $result = $this->model::find($param)->update($data);
        return $result ? true : false;
    }

    public function delete(int $id): bool
    {
        return $this->model::destroy($id) ? true : false;
    }

    public function searchBy(
        string $string,
        array $searchFields,
        int $limit = 10,
        array $orderBy = []
    ): array {
        $results = $this->model::where($searchFields[0], 'like', '%' . $string . '%');

        // Adição dos demais campos na busca
        if (count($searchFields) > 1) {
            foreach ($searchFields as $field) {
                $results->orWhere($field, 'like', '%' . $string . '%');
            }
        }
        
        // Tratamento do order by
        $results = $this->resolveOrderBy($orderBy, $results);
        
        // Retorna os resultados com paginação
        return $results->paginate($limit)
            ->appends([
                'order_by' => implode(',', array_keys($orderBy)),
                'q' => $string,
                'limit' => $limit
            ])->toArray();
    }

    protected function resolveOrderBy($orderBy, $results){
        foreach ($orderBy as $key => $value) {
            if (strstr($key, '-')) {
                $key = substr($key, 1);
            }
            $results->orderBy($key, $value);
        }
        return $results;
    }
}
