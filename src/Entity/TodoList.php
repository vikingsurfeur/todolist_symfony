<?php
namespace App\Entity;
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
     * @Assert\Length(min="2", max="80", minMessage="La couleur saisie est trop court", maxMessage="La couleur saisie est trop long")
     * @ORM\Column(type="string", length="80")
     */
    private string $color;

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
}
