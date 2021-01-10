<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeController extends AbstractController
{
   private $repository;

   public function __construct(TypeRepository $repository){
      $this->repository = $repository;
   }
    /**
     * @Route("/types", name="types")
     */
    public function index(): Response
    {
       $types = $this->repository->findAll();

        return $this->render('type/types.html.twig', [
           'types' => $types
        ]);
    }
}
