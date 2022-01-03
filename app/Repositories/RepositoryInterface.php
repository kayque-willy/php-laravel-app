<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function create(array $data): array;

    public function findAll(int $limit = 10, array $orderBy = []): array;

    public function findOneBy(int $id): array;

    public function editBy(string $param, array $data): bool;

    public function delete(int $id): bool;

    public function searchBy(
        string $string,
        array $searchFields,
        int $limit = 10,
        array $orderBy = []
    ): array;
}
