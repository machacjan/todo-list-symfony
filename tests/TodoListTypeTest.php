<?php declare(strict_types=1);

namespace App\Tests\Form\Type;

use App\Entity\TodoList;
use App\Entity\TodoListItem;
use App\Form\Type\TodoListType;
use Symfony\Component\Form\Test\TypeTestCase;

class TodoListTypeTest extends TypeTestCase
{

    public function testSubmitData(): void
    {
        $formData = [
            'name' => 'Grocery List',
            'items' => [
                [
                    'checked' => true,
                    'name' => 'Buy milk',
                ],
                [
                    'checked' => false,
                    'name' => 'Buy bread',
                ],
            ],
        ];

        $todoList = new TodoList();

        $form = $this->factory->create(TodoListType::class, $todoList);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($todoList, $form->getData());
        $this->assertEquals('Grocery List', $form->get('name')->getData());
        $this->assertCount(2, $form->get('items'));
        $this->assertInstanceOf(TodoListItem::class, $form->get('items')->get('0')->getData());
        $this->assertInstanceOf(TodoListItem::class, $form->get('items')->get('1')->getData());
        $this->assertTrue($form->get('items')->get('0')->get('checked')->getData());
        $this->assertFalse($form->get('items')->get('1')->get('checked')->getData());
        $this->assertEquals('Buy milk', $form->get('items')->get('0')->get('name')->getData());
        $this->assertEquals('Buy bread', $form->get('items')->get('1')->get('name')->getData());
    }

}
