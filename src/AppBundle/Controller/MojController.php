<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MojController extends Controller
{
    public function indexAction(Request $request)
    {
        $books = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Books')
            ->findAll();

        if (!$books) {
            throw $this->createNotFoundException('No books found');
        }

        return $this->render('AppBundle:Moj:index.html.twig', ['books' => $books]);
    }

    public function editAction()
    {
        return $this->render('@App/Moj/edit.html.twig');
    }

    public function getAction($id)
    {
        $book = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Books')
            ->find($id);
        return $this->render('@App/Moj/get.html.twig', ['book' => $book]);
    }

    public function addAction()
    {
        return $this->render('@App/Moj/add.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('@App/Moj/delete.html.twig', ['id' => $id]);
    }

}
