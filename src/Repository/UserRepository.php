<?php

declare(strict_types=1);

namespace App\Repository;

use App\User;

interface UserRepository
{

    public function getFirstUser(): User;

    public function getUsers(int $limit = 100): array;

    public function getRandomUser(): User;

}