<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\TodoList;
use App\Form\Type\TodoListType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route(path: '/{id<\d+>?}', name: 'app_index')]
    public function index(Request $request, EntityManagerInterface $entityManager, ?TodoList $todoList = null): Response
    {
        if (\is_null($todoList)) {
            $todoList = new TodoList();
        }

        $form = $this->createForm(TodoListType::class, $todoList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var TodoList */
            $todoList = $form->getData();

            $entityManager->persist($todoList);

            $entityManager->flush();

            return $this->redirectToRoute('app_index', ['id' => $todoList->getId()]);

        }

        $arguments = [
            'todo_list' => $todoList,
            'form' => $form,
        ];

        return $this->render('base.html.twig', $arguments);
    }

}