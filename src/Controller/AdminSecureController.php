<?php

namespace App\Controller;

use App\Form\RegisterType;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSecureController extends AbstractController
{
    /**
     * @Route("/admin/register", name="admin_register")
     */
    public function register(Request $request, EntityManagerInterface $entity, UserPasswordEncoderInterface $encoder): Response
    {
       $user = new Utilisateur;

      $form = $this->createForm(RegisterType::class, $user);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
         $passwordCrypt = $encoder->encodePassword($user, $user->getPassword());
         $user->setPassword($passwordCrypt);

         $entity->persist($user);
         $entity->flush();

         return $this->redirectToRoute('aliments');
      }
        return $this->render('admin_secure/register.html.twig',[
           'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login()
    {
      return $this->render('admin_secure/login.html.twig');
    }

        /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout()
    {

    }
}
