<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\TodoListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as Orm;

#[Orm\Entity(TodoListRepository::class)]
class TodoList
{

    #[Orm\Id]
    #[Orm\Column(type: Types::INTEGER)]
    #[Orm\GeneratedValue()]
    private int $id;

    #[Orm\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $name = '';

    /**
     * @var Collection<TodoListItem>
     */
    #[Orm\OneToMany(targetEntity: TodoListItem::class, mappedBy: 'list', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $items;


    public function __construct()
    {
        $this->items = new ArrayCollection();
    }


    /**
     * @param array<string,mixed> $data
     */
    public function __unserialize(array $data): void
    {
        if (\array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }

        if (\array_key_exists('items', $data)) {

            $unserializedItems = [];

            foreach ($data['items'] as $item) {

                $unserializedItem = new TodoListItem();

                $unserializedItem->__unserialize($item);

                $unserializedItems[] = $unserializedItem;

            }

            $this->items = new ArrayCollection($unserializedItems);

        }
    }


    /**
     * @return array<string,mixed>
     */
    public function __serialize(): array
    {
        $data = [
            'name' => $this->name,
            'items' => [],
        ];

        foreach ($this->items as $item) {
            $data['items'][] = $item->__serialize();
        }

        return $data;
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


    /**
     * @return Collection<TodoListItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }


    public function addItem(TodoListItem $item): self
    {
        if (!$this->items->contains($item)) {

            $this->items[] = $item;

            $item->setList($this);
        }

        return $this;
    }


    public function removeItem(TodoListItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
        }

        return $this;
    }

}