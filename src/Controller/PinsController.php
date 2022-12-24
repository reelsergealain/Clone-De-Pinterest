<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    #[Route('/', name: 'pins.index')]
    public function index(PinRepository $pinRepository): Response
    {
        return $this->render('pins/index.html.twig', [
            'pins' => $pinRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/pins/{id<\d+>}', name: 'pins.show')]
    public function show(Pin $pin): Response
    {

        return $this->render('pins/show.html.twig', [
            'pin' => $pin,
        ]);
    }

    #[Route('/pins/create', name: 'pins.create')]
    public function create(PinRepository $pinRepository, Request $request): Response
    {
        $pin = new Pin;
        $form = $this->createForm(PinType::class, $pin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pinRepository->save($pin, true);
            return $this->redirectToRoute('pins.index');
        }

        return $this->renderForm('pins/create.html.twig', [
            'pin' => $pin,
            'form' => $form,
        ]);
    }

    #[Route('/pins/{id<\d+>}/edit', name: 'pins.edit')]
    public function edit(Pin $pin, PinRepository $pinRepository, Request $request): Response
    {
        $form = $this->createForm(PinType::class, $pin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pinRepository->save($pin, true);
            return $this->redirectToRoute('pins.index');
        }

        return $this->renderForm('pins/edit.html.twig', [
            'pin' => $pin,
            'form' => $form,
        ]);
    }

    #[Route('/pins/{id<\d+>}/delete', name: 'pins.delete')]
    public function delete(Pin $pin, PinRepository $pinRepository, Request $request): Response
    {

        return $this->renderForm('pins/edit.html.twig', [
            
        ]);
    }
}
