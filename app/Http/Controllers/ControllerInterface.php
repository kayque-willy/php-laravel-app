<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ControllerInterface
{
    public function create(Request $request): JsonResponse;

    public function findAll(Request $request): JsonResponse;

    public function findOneBy(Request $request, int $id): JsonResponse;

    public function editBy(Request $request, string $param): JsonResponse;

    public function delete(Request $request, int $id): JsonResponse;
}
