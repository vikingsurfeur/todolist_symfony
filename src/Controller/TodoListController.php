<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Form\TodoListType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController extends AbstractController
{
    /**
     * @Route ("/create-list", name="create_list")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response {
        $todoList = new TodoList();

        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($todoList);
            $em->flush();
            return $this->redirectToRoute("read_all");
        }

        return $this->render("todo_list/create.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route ("/", name="read_all")
     * @return Response
     */
    public function readAll(): Response
    {
        $repository = $this->getDoctrine()->getRepository(TodoList::class);
        $todoLists = $repository->findAll();

        return $this->render("/todo_list/index.html.twig", [
            "todoLists" => $todoLists,
        ]);
    }

    /**
     * @Route ("/update-list/{id}", name="update_list")
     * @param TodoList $list
     * @param Request $request
     * @return Response
     */
    public function update(TodoList $list, Request $request): Response
    {
        $form = $this->createForm(TodoListType::class, $list);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("read_all");
        }

        return $this->render("todo_list/create.html.twig", [
            "form" => $form->createView(),
            "list" => $list,
        ]);
    }

    /**
     * @Route ("/delete-list/{id}", name="delete_list")
     * @param TodoList $list
     * @return Response
     */
    public function delete(TodoList $list): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($list);
        $em->flush();
        return $this->redirectToRoute("read_all");
    }
}