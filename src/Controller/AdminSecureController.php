<?php

namespace App\Controller;

use App\Form\RegisterType;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSecureController extends AbstractController
{
    /**
     * @Route("/admin/register", name="admin_register")
     */
    public function index(Request $request, EntityManagerInterface $entity): Response
    {
       $user = new Utilisateur;

      $form = $this->createForm(RegisterType::class, $user);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
         $entity->persist($user);
         $entity->flush();

         return $this->redirectToRoute('aliments');
      }
        return $this->render('admin_secure/register.html.twig',[
           'form' => $form->createView()
        ]);
    }
}
