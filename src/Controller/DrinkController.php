<?php

namespace App\Controller;

use App\Entity\Drink;
use App\Form\DrinkType;
use App\Repository\DrinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/drink")
 */
class DrinkController extends AbstractController
{
    /**
     * @Route("/", name="drink_index", methods={"GET"})
     */
    public function index(DrinkRepository $drinkRepository): Response
    {
        return $this->render('drink/index.html.twig', [
            'drinks' => $drinkRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="drink_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $drink = new Drink();
        $form = $this->createForm(DrinkType::class, $drink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($drink);
            $em->flush();

            return $this->redirectToRoute('drink_index');
        }

        return $this->render('drink/new.html.twig', [
            'drink' => $drink,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="drink_show", methods={"GET"})
     */
    public function show(Drink $drink): Response
    {
        return $this->render('drink/show.html.twig', [
            'drink' => $drink,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="drink_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Drink $drink, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(DrinkType::class, $drink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('drink_index');
        }

        return $this->render('drink/edit.html.twig', [
            'drink' => $drink,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="drink_delete", methods={"POST"})
     */
    public function delete(Request $request, Drink $drink, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$drink->getId(), $request->request->get('_token'))) {
            $em->remove($drink);
            $em->flush();
        }

        return $this->redirectToRoute('drink_index');
    }
}
