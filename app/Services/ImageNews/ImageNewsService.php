<?php

namespace App\Services\ImageNews;

use App\Services\AbstractService;
use InvalidArgumentException;

class ImageNewsService extends AbstractService
{
    public function findByNews(int $newsId): array
    {
        return $this->repository->findByNews($newsId);
    }

    public function deleteByNews(int $newsId): bool
    {
        return $this->repository->deleteByNews($newsId);
    }

}
