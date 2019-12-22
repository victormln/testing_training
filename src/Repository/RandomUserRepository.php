<?php

declare(strict_types=1);

namespace App\Repository;

use App\User;

final class RandomUserRepository implements UserRepository
{

    private const RANDOM_USER_BASE_URL = 'https://randomuser.me/api';

    public function getUser(): User
    {
        $url = self::RANDOM_USER_BASE_URL;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if (!$result) {
            throw new \HttpResponseException('Invalid response when trying to get randomUser');
        }

        $responseObject = json_decode($result);

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
        $url = self::RANDOM_USER_BASE_URL . '?results=' . $limit;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if (!$result) {
            throw new \HttpResponseException('Invalid response when trying to get randomUser');
        }

        $allUsers = json_decode($result);

        $users = [];
        for ($counterOfUsers = 0; $counterOfUsers < $limit; $counterOfUsers++) {
            $currentUser = $allUsers->results[$counterOfUsers];
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