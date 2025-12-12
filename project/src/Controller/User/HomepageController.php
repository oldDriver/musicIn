<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'user_homepage')]
    public function homepage(): Response
    {
        $user = $this->getUser();

        return $this->render('user/homepage.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
