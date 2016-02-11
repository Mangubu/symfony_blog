<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Blogger\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Form\Type\BlogType;
/**
 * Blog controller.
 */
class BlogController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array(
            'blog'      => $blog,
        ));
    }

    public function newAction($request)
    {
      $em = $this->getDoctrine()->getEntityManager();

      $blog = new Blog();
      $form = $this->createForm(BlogType::class, $blog);

      if($request->isMethod('POST')){

          $form->handleRequest('$request');
          var_dump($request);
          die;

      }

      // if ($form->isValid()) {
      //     $em = $this->getDoctrine()->getManager();
      //     $em->persist($blog);
      //     $em->flush();
      //
      //     return $this->redirectToRoute('BloggerBlogBundle_succes');
      // }

      return $this->render('BloggerBlogBundle:Blog:new.html.twig', array(
           'form'      => $form->createView(),
      ));
    }


    public function createAction()
    {


    }
}
