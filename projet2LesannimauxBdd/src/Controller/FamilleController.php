<?php

namespace App\Controller;


use App\Repository\FamilleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FamilleController extends AbstractController
{
    /**
     * @Route("/familles", name="familles")
     */
    public function index(FamilleRepository $repository)
    {
        $familles = $repository->findAll();
        return $this->render('famille/familles.html.twig', [
            "familles" => $familles
        ]);
    }
}
