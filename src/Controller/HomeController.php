<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Salle;
use App\Repository\AbonnementRepository;
use App\Repository\SalleRepository;

class HomeController extends AbstractController
{
    #[Route('/en', name: 'app_home')]
    public function index(SalleRepository $salleRepository): Response
    {
        // Fetch all classes from the database
        $salles = $salleRepository->findAll();

        return $this->render('home/index.html.twig', [
            'salles' => $salles,
        ]);
    }
    #[Route('/salle/{id}/abonnements', name: 'salle_abonnements')]
    public function salleAbonnement(Salle $salle, AbonnementRepository $abonnementRepository): Response
    {
        $abonnements = $abonnementRepository->findBy(['salle' => $salle]);
        return $this->render('home/abonnement.html.twig', [
            'abonnements' => $abonnements,
            'salle' => $salle,
        ]);
    }
}
