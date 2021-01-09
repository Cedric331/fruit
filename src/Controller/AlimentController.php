<?php

namespace App\Controller;

use Doctrine\ORM\EntityRepository;
use App\Repository\AlimentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlimentController extends AbstractController
{
   private $repository;

   public function __construct(AlimentRepository $repository){
      $this->repository = $repository;
   }

    /**
     * @Route("/", name="aliments")
     */
    public function index(): Response
    {
       $aliments = $this->repository->findAll();

        return $this->render('aliment/aliments.html.twig', [
           'aliments' => $aliments,
           'isCalorie' => false,
           'isGlucide' => false,
        ]);
    }

      /**
     * @Route("/aliment/{name}", name="aliment")
     */
    public function alimentName($name): Response
    {
       $aliment = $this->repository->getAlimentName($name);

        return $this->render('aliment/aliment.html.twig', [
           'aliment' => $aliment
        ]);
    }

          /**
     * @Route("/alimentCalorie/{calorie}", name="alimentCalorie")
     */
    public function alimentCalorie($calorie): Response
    {
       $aliments = $this->repository->getAlimentPropriete('calorie', '<', $calorie);

        return $this->render('aliment/aliments.html.twig', [
           'aliments' => $aliments,
           'isCalorie' => true,
           'isGlucide' => false,
        ]);
    }

      /**
     * @Route("/alimentGlucide/{glucide}", name="alimentGlucide")
     */
    public function alimentGlucide($glucide): Response
    {
       $aliments = $this->repository->getAlimentPropriete('glucide', '<', $glucide);

        return $this->render('aliment/aliments.html.twig', [
           'aliments' => $aliments,
           'isCalorie' => false,
           'isGlucide' => true,
        ]);
    }
}
