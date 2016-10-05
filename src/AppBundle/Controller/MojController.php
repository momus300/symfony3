<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MojController extends Controller
{
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Moj:index.html.twig');
    }

    public function editAction()
    {
        return $this->render('@App/Moj/edit.html.twig');
    }

    public function getAction()
    {
        return $this->render('@App/Moj/get.html.twig');
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
