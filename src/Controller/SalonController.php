<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Salon;
use App\Form\AccessSalonType;
use App\Form\PostType;
use App\Form\SalonType;
use App\Repository\SalonRepository;
use App\Service\Slugify;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
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
    public function index(): Response
    {
        return $this->render('salon/index.html.twig', [
        ]);
    }

    /**
     * @Route("/new", name="salon_new", methods={"GET","POST"})
     */
    public function new(Request $request, Slugify $slugify): Response
    {
        $salon = new Salon();
        $form = $this->createForm(SalonType::class, $salon);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($salon->getName());
            $salon->setSlug($slug);
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
     * @Route("/accessuser", name="salon_accessuser", methods={"GET","POST"})
     */
    public function accessUser(Request $request, SalonRepository $salonRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccessSalonType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['salon'];
            $salon = $salonRepository->findOneBy(['slug' => $search]);
            if ($salon){
                $salon->addUser($this->getUser());
                $entityManager->flush();
                return $this->redirectToRoute('salon_index');
            }
        } else {
            $this->addFlash('danger', 'Ce salon n\'existe pas');
        }
        return $this->render('salon/access.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salon_show", methods={"GET","POST"})
     */
    public function show(Salon $salon, Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $post->setUser($user);
            $post->setSalon($salon);
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_all', [
                'id' => $salon->getId(),
            ]);
        }

        return $this->render('salon/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
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
