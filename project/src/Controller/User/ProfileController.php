<?php

namespace App\Controller\User;

use App\Form\Type\UserFeaturesType;
use App\Form\Type\UserGenresType;
use App\Form\Type\UserInstrumentsType;
use App\Form\Type\UserNameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/profile')]
#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('', name: 'user_profile_view', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('user/profile.html.twig',
            [
                'user' => $user,
            ]
        );
    }

    #[Route('/edit/name', name: 'user_edit_name', methods: ['GET', 'POST'])]
    public function editName(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserNameType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_profile_view');
        }

        return $this->render('user/forms/user.html.twig', ['form' => $form]);
    }

    #[Route('/edit/features', name: 'user_edit_features', methods: ['GET', 'POST'])]
    public function editFeatures(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserFeaturesType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_profile_view');
        }

        return $this->render('user/forms/user.html.twig', ['form' => $form]);
    }

    #[Route('/edit/instruments', name: 'user_edit_instruments', methods: ['GET', 'POST'])]
    public function editInstruments(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserInstrumentsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_profile_view');
        }

        return $this->render('user/forms/user.html.twig', ['form' => $form]);
    }

    #[Route('/edit/genres', name: 'user_edit_genres', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function editGenres(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserGenresType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_profile_view');
        }

        return $this->render('user/forms/user.html.twig', ['form' => $form]);
    }
}
