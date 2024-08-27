<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/account', name: 'app_user')]
class UserController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if(!is_null($user)) {
            $id = $user->getUserIdentifier();

            $user = $userRepository->findOneByUserIdentifier($id);

            return $this->render('user/index.html.twig', [
                'controller_name' => $id,
                'user' => $user,
            ]);
        }

        return $this->redirectToRoute('app_security_login', [], Response::HTTP_PERMANENTLY_REDIRECT);
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $user->getPassword();

            $hashed = password_hash($plainPassword, PASSWORD_DEFAULT);
            $user->setPassword($hashed);

            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    #[Route('/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if(!is_null($user)) {
            $id = $user->getUserIdentifier();

            $user = $userRepository->findOneByUserIdentifier($id);

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $userRepository->save($user, true);

                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('user/new.html.twig', [
                'user' => $user,
                'form' => $form
            ]);
        }
    }
}
