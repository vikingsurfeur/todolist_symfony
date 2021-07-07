<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="list")
 */
class TodoList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner le nom de la liste")
     * @Assert\Length(min="2", max="80", minMessage="Le nom saisi est trop court", maxMessage="Le nom saisi est trop long")
     * @ORM\Column(type="string", length="80")
     */
    private string $name;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner la couleur de la liste")
     * @Assert\Length(min="2", max="10", minMessage="La couleur saisie est trop court", maxMessage="La couleur saisie est trop long")
     * @ORM\Column(type="string", length="10")
     */
    private string $color;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="list", orphanRemoval=true)
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TodoList
     */
    public function setName(string $name): TodoList
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return TodoList
     */
    public function setColor(string $color): TodoList
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TodoList
     */
    public function setId(int $id): TodoList
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setList($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getList() === $this) {
                $task->setList(null);
            }
        }

        return $this;
    }
}
