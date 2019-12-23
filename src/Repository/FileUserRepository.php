<?php

declare(strict_types=1);

namespace App\Repository;

use App\User;

final class FileUserRepository implements UserRepository
{

    /** @var array */
    private $users;

    public function __construct()
    {
        $fileUsersContent = json_decode(file_get_contents(__DIR__ . '/users.json'));
        $this->users = $fileUsersContent->results;
    }

    public function getFirstUser(): User
    {
        return new User(
            $this->users[0]->name->title . ' ' . $this->users[0]->name->first . ' ' . $this->users[0]->name->last,
            $this->users[0]->email,
            $this->users[0]->picture->large,
            $this->users[0]->gender,
            $this->users[0]->location->country
        );
    }

    public function getUsers(int $limit = 100): array
    {
        $users = [];
        for ($counterOfUsers = 0; $counterOfUsers < $limit; $counterOfUsers++) {
            $currentUser = $this->users[$counterOfUsers];
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

    public function getRandomUser(): User
    {
        $userNumber = random_int(0, count($this->users) - 1);

        return new User(
            $this->users[$userNumber]->name->title . ' ' . $this->users[$userNumber]->name->first,
            $this->users[$userNumber]->email,
            $this->users[$userNumber]->picture->large,
            $this->users[$userNumber]->gender,
            $this->users[$userNumber]->location->country
        );
    }
}