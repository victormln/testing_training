<?php

declare(strict_types=1);

namespace App\Repository;

use App\User;

interface UserRepository
{

    public function getUser(): User;

    public function getUsers(int $limit = 3): array;

}