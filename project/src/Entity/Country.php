<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: 'App\Repository\CountryRepository')]
#[ORM\UniqueConstraint(name: 'uniq_5373c9665e237e06', columns: ['name'])]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 100)]
    #[Assert\Unique]
    private string $name;

    /**
     * @var ArrayCollection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'country')]
    private Collection $persons;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @codeCoverageIgnore
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }

    public function addPerson(User $person): static
    {
        if (!$this->persons->contains($person)) {
            $this->persons->add($person);
            $person->setCountry($this);
        }

        return $this;
    }

    public function removePerson(User $person): static
    {
        if ($this->persons->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getCountry() === $this) {
                $person->setCountry(null);
            }
        }

        return $this;
    }
}
