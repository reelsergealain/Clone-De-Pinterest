<?php

namespace App\Controller;

use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    #[Route('/', name: 'pins.index')]
    public function index(PinRepository $pinRepository): Response
    {
        return $this->render('pins/index.html.twig', [
            'pins' => $pinRepository->findAll(),
        ]);
    }
}
