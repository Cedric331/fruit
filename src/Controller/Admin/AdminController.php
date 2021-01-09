<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ObjectManager;

class AdminController extends AbstractController
{

   private $repository;

   public function __construct(AlimentRepository $repository){
      $this->repository = $repository;
   }

    /**
     * @Route("/admin", name="admin_admin")
     */
    public function index(): Response
    {
       $aliments = $this->repository->findAll();

        return $this->render('admin/admin.html.twig',[
           'aliments' => $aliments
        ]);
    }

   /**
     * @Route("/admin/create", name="admin_create")
     * @Route("/admin/update/{id}", name="admin_update", methods="GET|POST")
     */
    public function update(Aliment $aliment = null, Request $request, EntityManagerInterface $entityManager): Response
    {
       if(!$aliment)
       {
          $aliment = new Aliment;
       }

      $form = $this->createForm(AlimentType::class, $aliment);

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
         $modif = $aliment->getId() != null;
         $entityManager->persist($aliment);
         $entityManager->flush();
         $this->addFlash('success', ($modif) ? 'Modification effectuée' : 'Element créé');
         return $this->redirectToRoute('admin_admin');
      }

        return $this->render('admin/update.html.twig',[
           'aliment' => $aliment,
           'form' => $form->createView(),
           'isUpdate' => $aliment->getId() != null
        ]);
    }

      /**
     * @Route("/admin/delete/{id}", name="admin_delete", methods="delete")
     */
    public function delete(Aliment $aliment, Request $request, EntityManagerInterface $entityManager): Response
    {
       if($this->isCsrfTokenValid('SUP'.$aliment->getId(), $request->get('_token')))
       {
         $entityManager->remove($aliment);
         $entityManager->flush();
         $this->addFlash('danger', 'Element supprimé');
         return $this->redirectToRoute('admin_admin');
       }
       $this->addFlash('danger', 'Action non autorisé');
       return $this->redirectToRoute('admin_admin');
    }
}
