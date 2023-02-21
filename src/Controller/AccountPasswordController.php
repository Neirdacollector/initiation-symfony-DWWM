<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/modifier-mot-de-passe', name: 'app_account_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $notification = null;
        $user = $this -> getUser();
        $form = $this -> createForm(ChangePasswordType::class,$user);
        $form->handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()){

            $old_pdw = $form -> get('old_password') -> getData();

            if($passwordHasher -> isPasswordValid($user, $old_pdw)){

                $new_pdw = $form -> get('new_password') -> getData();
                $password = $passwordHasher -> hashPassword($user, $new_pdw);
                $user -> setPassword($password);
                $this -> entityManager -> flush();

                $notification = 'Le mot de passe a été mis à jour';
            } else {
                $notification = 'Le mot de passe actuel est erroné';
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form -> createView(),
            'notification' => $notification
        ]);
    }
}
