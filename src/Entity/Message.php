<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;

#[ApiResource(paginationItemsPerPage: 10,operations: [
 new GetCollection(normalizationContext: ['groups' => 'message:list']),
 new Post(),
 new Get(normalizationContext: ['groups' => 'message:item']),
 new Put(),
 new Patch(),
 new Delete(),
],)]

#[ApiFilter(SearchFilter::class, properties: ['user' => 'exact'])]
#[ApiFilter(OrderFilter::class, properties: ['id' => 'ASC', 'titre' => 'DESC'])]
#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['message:list', 'message:item'])]
    private ?int $id = null;
    #[ORM\Column(length: 50)]
    #[Groups(['message:list', 'message:item'])]
    private ?string $titre = null;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['message:list', 'message:item'])]
    private ?\DateTimeInterface $datePoste = null;
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['message:list', 'message:item'])]
    private ?string $contenu = null;
    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['message:list', 'message:item'])]
    private ?User $user = null;
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['message:list', 'message:item'])]
    private ?self $parent = null;
    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class, orphanRemoval: true)]
    private Collection $messages;
    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitre(): ?string
    {
        return $this->titre;
    }
    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }
    public function getDatePoste(): ?\DateTimeInterface
    {
        return $this->datePoste;
    }
    public function setDatePoste(\DateTimeInterface $datePoste): static
    {
        $this->datePoste = $datePoste;
        return $this;
    }
    public function getContenu(): ?string
    {
        return $this->contenu;
    }
    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;
        return $this;
    }
    public function getUser(): ?User
    {
        return $this->user;
    }
    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }
    public function getParent(): ?self
    {
        return $this->parent;
    }
    public function setParent(?self $parent): static
    {
        $this->parent = $parent;
        return $this;
    }
    /**
     * @return Collection<int, self>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }
    public function addMessage(self $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setParent($this);
        }
        return $this;
    }
    public function removeMessage(self $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getParent() === $this) {
                $message->setParent(null);
            }
        }
        return $this;
    }
}
