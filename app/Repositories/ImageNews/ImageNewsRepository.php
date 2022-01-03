<?php

namespace App\Repositories\ImageNews;

use App\Repositories\AbstractRepository;

class ImageNewsRepository extends AbstractRepository
{
    // ---------------------- Metodos especificos do ImageNewsRepository ----------------------
    public function findByNews(int $newsId): array
    {
        return $this->model::where('news_id', $newsId)->get()->toArray();
    }

    public function deleteByNews(int $newsId): bool
    {
        $result = $this->model::where('news_id', $newsId)->delete();
        return $result ? true : false;
    }
}
