<?php

namespace App\Controller;

use App\Entity\Salon;
use App\Form\SalonType;
use App\Repository\SalonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salon")
 */
class SalonController extends AbstractController
{
    /**
     * @Route("/", name="salon_index", methods={"GET"})
     */
    public function index(SalonRepository $salonRepository): Response
    {
        return $this->render('salon/index.html.twig', [
            'salons' => $salonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="salon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salon = new Salon();
        $form = $this->createForm(SalonType::class, $salon);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $salon->setSlug();
            $salon->addUser($user);
            $entityManager->persist($salon);
            $entityManager->flush();

            return $this->redirectToRoute('salon_index');
        }

        return $this->render('salon/new.html.twig', [
            'salon' => $salon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salon_show", methods={"GET"})
     */
    public function show(Salon $salon): Response
    {
        return $this->render('salon/show.html.twig', [
            'salon' => $salon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salon $salon): Response
    {
        $form = $this->createForm(SalonType::class, $salon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salon_index');
        }

        return $this->render('salon/edit.html.twig', [
            'salon' => $salon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Salon $salon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salon_index');
    }
}
