<?php

namespace App\Services\News;

use App\Services\AbstractService;
use Illuminate\Support\Str;


class NewsService extends AbstractService
{
    public function create(array $data): array
    {
        $data['slug'] = str::slug($data['title'] . ' ' . $data['subtitle']);
        return $this->repository->create($data);
    }

    public function editBy(string $param, array $data): bool
    {
        $data['slug'] = str::slug($data['title'] . ' ' . $data['subtitle']);
        return $this->repository->editBy($param, $data);
    }

    public function findByAuthor(int $authorId, int $limit = 10, $orderBy = []): array
    {
        return $this->repository->findByAuthor($authorId, $limit, $orderBy);
    }

    public function findBy(string $param): array
    {
        return $this->repository->findBy($param);
    }

    public function deleteBy(string $param): bool
    {
        return $this->repository->deleteBy($param);
    }

    public function deleteByAuthor(int $authorId): bool
    {
        return $this->repository->deleteByAuthor($authorId);
    }
}
