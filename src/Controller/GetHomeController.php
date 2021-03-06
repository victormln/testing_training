<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GetHomeController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        $user = $this->userRepository->getFirstUser();

        return $this->render('default/index.html.twig', [
            'user' => $user
        ]);
    }
}