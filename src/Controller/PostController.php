<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

        return $this->render('post/all.html.twig', [
            'salon' => $salon,

        ]);
    }

    /**
     * @Route("/show/{id}", name="_show", methods={"GET","POST"})
     */
    public function show(Salon $salon, Request $request): Response
    {

        return $this->render('post/show.html.twig', [
            'salon' => $salon,

        ]);
    }

    /**
     * @Route("/addcomm/{post}/{salon}", name="_addcomm", methods={"GET","POST"})
     * @ParamConverter("salon", class="App\Entity\Salon", options={"mapping": {"salon": "name"}})
     */
    public function addcomm(Request $request, Post $post, Salon $salon): Response
    {
        $comment = new Comment();
        $comm = $request->get($post->getId());
        $user = $this->getUser();
        $postId = $post->getId();

        $entityManager = $this->getDoctrine()->getManager();
        $comment->setUser($user);
        $comment->setComment($comm);
        $comment->setPost($post);
        $entityManager->persist($comment);
        $entityManager->flush();

        return $this->redirectToRoute('post_all', [
            'salon' => $salon,
            'id' => $salon->getId(),
        ]);
    }

}
