<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Authors;
use AppBundle\Entity\Books;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MojController extends Controller
{
    public function indexAction(Request $request)
    {
        $books = $this->getDoctrine()
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

    public function addAction(Request $request)
    {
        $authors = $this->getDoctrine()->getRepository('AppBundle:Authors')->findAll();
        $book = new Books();
        $book->setCreateAt(new \DateTime('now'));
        $book->setModifiedAt(new \DateTime('now'));

        $Form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('description', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('author', ChoiceType::class, ['choices'=> [$authors], 'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary']])
            ->getForm();

        $Form->handleRequest($request);

        if ($Form->isSubmitted() && $Form->isValid()) {
            $book->setAuthor($Form['title']->getData());
            $book->setTitle($Form['title']->getData());
            $book->setDescription($Form['description']->getData());

            $em = $this->getDoctrine()->getManager();

            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'Rekord dodany');

            return $this->redirectToRoute('moj');
        }

        return $this->render('@App/Moj/add.html.twig', ['form' => $Form->createView()]);
    }

    public function deleteAction($id)
    {
        return $this->render('@App/Moj/delete.html.twig', ['id' => $id]);
    }

}
