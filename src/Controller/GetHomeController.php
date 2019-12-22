<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;

final class GetHomeController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        $user = $this->userRepository->getUser();

        $response = new Response();
        $response->setContent(json_encode([
            'data' => [
                'name' => $user->name(),
                'imageUrl' => $user->imageUrl(),
                'gender' => $user->gender(),
            ],
        ]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}