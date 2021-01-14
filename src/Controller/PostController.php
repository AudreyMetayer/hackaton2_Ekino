<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Salon;
use App\Form\CommentType;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/post", name="post")
 */
class PostController extends AbstractController
{

    /**
     * @Route("/all/{id}", name="_all", methods={"GET","POST"})
     */
    public function posts(Salon $salon, Request $request): Response
    {
        $comment = new Comment();
        $formComment = $this->createForm(CommentType::class, $comment);
        $formComment->handleRequest($request);
        $user = $this->getUser();


        if ($formComment->isSubmitted() && $formComment->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->addUser($user);
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('salon_all');
        }
        return $this->render('post/all.html.twig', [
            'salon' => $salon,
            'form' => $formComment->createView()
        ]);
    }

}
