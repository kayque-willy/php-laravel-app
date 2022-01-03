<?php

namespace App\Repositories\News;

use App\Repositories\AbstractRepository;

class NewsRepository extends AbstractRepository
{
    // ---------------------- Métodos especificos do NewsRepository ----------------------
    public function findByAuthor(int $authorId, int $limit = 10, array $orderBy = []): array
    {
        $results = $this->model::where('author_id', $authorId);

        // Tratamento do order by
        $results = $this->resolveOrderBy($orderBy, $results);

        // Retorna os resultados com paginação
        return $results->paginate($limit)
            ->appends([
                'order_by' => implode(',', array_keys($orderBy)),
                'limit' => $limit
            ])->toArray();
    }

    public function findBy(string $param): array
    {
        $query = $this->model::query();

        if (is_numeric($param)) {
            $news = $query->findOrFail($param);
        } else {
            $news = $query->where('slug', 'ilike', '%' . $param . '%')->get();
        }
        
        return $news->toArray();
    }

    public function editBy(string $param, array $data): bool
    {
        if (is_numeric($param)) {
            $news = $this->model::find($param);
        } else {
            $news = $this->model::where('slug', $param);
        }
        return $news->update($data) ? true : false;
    }

    public function deleteBy(string $param): bool
    {
        if (is_numeric($param)) {
            $news = $this->model::destroy($param);
        } else {
            $news = $this->model::where('slug', $param)->delete();
        }
        return $news ? true : false;
    }

    public function deleteByAuthor(int $authorId): bool
    {
        $news = $this->model::where('author_id', $authorId)->delete();
        return $news ? true : false;
    }
}
