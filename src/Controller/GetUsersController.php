<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;

final class GetUsersController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        $users = $this->userRepository->getUsers();

        $usersInArray = [];
        foreach ($users as $user) {
            $usersInArray[] = [
                'name' => $user->name(),
                'imageUrl' => $user->imageUrl(),
                'gender' => $user->gender()
            ];
        }

        $response = new Response();
        $response->setContent(json_encode([
            'data' => $usersInArray
        ]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}