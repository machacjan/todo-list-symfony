<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\TodoListItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as Orm;

#[Orm\Entity(TodoListItemRepository::class)]
class TodoListItem
{

    #[Orm\Id]
    #[Orm\Column(type: Types::INTEGER)]
    #[Orm\GeneratedValue()]
    private int $id;

    #[Orm\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $name = '';

    #[Orm\ManyToOne(targetEntity: TodoList::class, inversedBy: 'list')]
    #[Orm\JoinColumn(nullable: false)]
    private TodoList $list;


    /**
     * @param array<string,mixed> $data
     */
    public function __unserialize(array $data): void
    {
        if (\array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }
    }


    /**
     * @return array<string,mixed>
     */
    public function __serialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getList(): TodoList
    {
        return $this->list;
    }


    public function setList(TodoList $list): self
    {
        $this->list = $list;

        return $this;
    }

}