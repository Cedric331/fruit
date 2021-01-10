<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTypeController extends AbstractController
{

   public $repository;

   public function __construct(TypeRepository $repository){
      $this->repository = $repository;
   }

    /**
     * @Route("/admin/type", name="admin_type")
     */
    public function index(): Response
    {
       $types = $this->repository->findAll();

        return $this->render('admin/type.html.twig', [
            'types' => $types,
        ]);
    }

      /**
     * @Route("/admin/type/create", name="admin_type_create")
     * @Route("/admin/type/update/{id}", name="admin_type_update", methods="GET|POST")
     */
    public function update(Type $type = null, Request $request, EntityManagerInterface $entity){
     
      if(!$type)
      {
         $type = new Type;
      }

      $form = $this->createForm(TypeType::class, $type);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
         $modif = $type->getId() != null;

         $entity->persist($type);
         $entity->flush();
         $this->addFlash('success', ($modif) ? 'Modification effectuée' : 'Element créé');
         return $this->redirectToRoute('admin_type');
      }

      return $this->render('admin/updateType.html.twig', [
          'form' => $form->createView(),
          'type' => $type,
          'isModification' => $type->getId() != null
      ]);
    }

    /**
     * @Route("/admin/type/delete/{id}", name="admin_type_delete", methods="delete")
     */
    public function delete(Type $type, EntityManagerInterface $entity, Request $request): Response
    {
      if($this->isCsrfTokenValid("DEL".$type->getId(), $request->get('_token')))
      {
         $entity->remove($type);
         $entity->flush();
         $this->addFlash('success', 'Element supprimé');
         return $this->redirectToRoute('admin_type');
      }

      $this->addFlash('success', 'Action non autorisé');
      return $this->redirectToRoute('admin_type');
    }
}
