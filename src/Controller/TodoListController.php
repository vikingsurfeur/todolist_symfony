<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Form\TodoListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController extends AbstractController
{
    /**
     * @Route ("/create-list", name="create_list")
     */
    
    public function create(Request $request): Response {
        $todoList = new TodoList();

        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($todoList);
            $em->flush();
        }

        return $this->render("todo_list/create.html.twig", [
            "form" => $form->createView()
        ]);
    }
}