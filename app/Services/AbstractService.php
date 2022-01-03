<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

abstract class AbstractService implements ServiceInterface
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): array
    {
        var_dump($data);
        return $this->repository->create($data);
    }

    public function findAll(int $limit = 10, array $orderBy = []): array
    {
        return $this->repository->findAll($limit, $orderBy);
    }

    public function findOneBy(int $id): array
    {
        return $this->repository->findOneBy($id);
    }

    public function editBy(string $param, array $data): bool
    {
        return $this->repository->editBy($param, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function searchBy(string $string, array $searchFields, int $limit = 10, array $orderBy = []): array
    {
        return $this->repository
            ->searchBy(
                $string,
                $searchFields,
                $limit,
                $orderBy
            );
    }
}
