<?php

declare(strict_types=1);

namespace App\Repository;

use App\User;

final class FileUserRepository implements UserRepository
{

    public function getUser(): User
    {
        $users = file_get_contents(__DIR__ . '/users.json');

        $responseObject = json_decode($users);

        return new User(
            $responseObject->results[0]->name->title . ' ' . $responseObject->results[0]->name->first,
            $responseObject->results[0]->email,
            $responseObject->results[0]->picture->large,
            $responseObject->results[0]->gender,
            $responseObject->results[0]->location->country
        );
    }

    public function getUsers(int $limit = 3): array
    {
        $usersInFile = json_decode(file_get_contents(__DIR__ . '/users.json'));

        $users = [];
        for ($counterOfUsers = 0; $counterOfUsers < $limit; $counterOfUsers++) {
            $currentUser = $usersInFile->results[$counterOfUsers];
            $users[] = new User(
                $currentUser->name->title . ' ' . $currentUser->name->first,
                $currentUser->email,
                $currentUser->picture->large,
                $currentUser->gender,
                $currentUser->location->country
            );
        }

        return $users;
    }
}