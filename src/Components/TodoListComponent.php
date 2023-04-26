<?php declare(strict_types=1);

namespace App\Components;

use App\Controller\IndexController;
use App\Entity\TodoList;
use App\Form\Type\TodoListType;
use App\Repository\TodoListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent('todo_list')]
class TodoListComponent extends AbstractController
{

    use DefaultActionTrait;

    use ComponentWithFormTrait;

    use LiveCollectionTrait;


    #[LiveProp(fieldName: 'data', dehydrateWith: 'dehydrateTodoList', hydrateWith: 'hydrateTodoList')]
    public TodoList $todoList;


    public function __construct(private TodoListRepository $todoListRepository, private EntityManagerInterface $entityManager)
    {}


    /**
     * @return array<string,mixed>
     */
    public function dehydrateTodoList(TodoList $todoList): array
    {
        return $todoList->__serialize();
    }


    /**
     * @param array<string,mixed> $data
     */
    public function hydrateTodoList(array $data): TodoList
    {
        $todoList = new TodoList();

        $todoList->__unserialize($data);

        return $todoList;
    }


    /**
     * @return array<TodoList>
     */
    public function lists(): array
    {
        /** @var array<TodoList> */
        $lists = $this->todoListRepository->findAll();

        return $lists;
    }


    public function isPartiallyFilled(): bool
    {
        if (!empty($this->todoList->getName())) {
            return true;
        }

        return !$this->todoList->getItems()->isEmpty();
    }


    #[LiveAction]
    public function new(): Response
    {
        return $this->redirectToRoute(IndexController::ROUTE_NAME);
    }


    #[LiveAction]
    public function delete(#[LiveArg()] int $id): Response
    {
        /** @var TodoList|null */
        $todoList = $this->todoListRepository->find($id);

        if (!\is_null($todoList)) {

            $this->entityManager->remove($todoList);

            $this->entityManager->flush();

        }

        return $this->redirectToRoute(IndexController::ROUTE_NAME);
    }


    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(TodoListType::class, $this->todoList);
    }

}