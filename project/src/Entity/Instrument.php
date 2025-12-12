<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: 'App\Repository\InstrumentRepository')]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    #[Assert\NotNull]
    private string $name;

    #[ORM\ManyToOne(targetEntity: InstrumentType::class, inversedBy: 'instruments', )]
    #[ORM\JoinColumn(name: 'instrument_type_id', referencedColumnName: 'id', nullable: false)]
    private InstrumentType $type;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'instrument')]
    private Collection $musicians;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'instruments')]
    private Collection $performers;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->musicians = new ArrayCollection();
        $this->performers = new ArrayCollection();
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

    public function getType(): ?InstrumentType
    {
        return $this->type;
    }

    public function setType(?InstrumentType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getMusicians(): Collection
    {
        return $this->musicians;
    }

    public function addMusician(User $musician): static
    {
        if (!$this->musicians->contains($musician)) {
            $this->musicians->add($musician);
            $musician->setInstrument($this);
        }

        return $this;
    }

    public function removeMusician(User $musician): static
    {
        if ($this->musicians->removeElement($musician)) {
            // set the owning side to null (unless already changed)
            if ($musician->getInstrument() === $this) {
                $musician->setInstrument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPerformers(): Collection
    {
        return $this->performers;
    }

    public function addPerformer(User $performer): static
    {
        if (!$this->performers->contains($performer)) {
            $this->performers->add($performer);
            $performer->addInstrument($this);
        }

        return $this;
    }

    public function removePerformer(User $performer): static
    {
        if ($this->performers->removeElement($performer)) {
            $performer->removeInstrument($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
