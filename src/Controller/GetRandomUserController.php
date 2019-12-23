<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GetRandomUserController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        $user = $this->userRepository->getRandomUser();

        return $this->render('default/random.html.twig', [
            'user' => $user
        ]);
    }
}