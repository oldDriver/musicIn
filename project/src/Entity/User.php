<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotNull]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\ManyToOne(targetEntity: Instrument::class, inversedBy: 'musicians')]
    #[ORM\JoinColumn(name: 'instrument_id', referencedColumnName: 'id')]
    private ?Instrument $instrument = null;

    /**
     * @var Collection<int, Instrument>
     */
    #[ORM\ManyToMany(targetEntity: Instrument::class, inversedBy: 'performers')]
    #[ORM\JoinTable(name: 'users_instruments')]
    private Collection $instruments;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'musicians')]
    #[ORM\JoinTable(name: 'users_genres')]
    private Collection $genres;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'persons')]
    #[ORM\JoinColumn(name: 'country_id', referencedColumnName: 'id')]
    private ?Country $country = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotNull]
    private string $firstName;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $middleName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(name: 'is_singer')]
    private bool $singer = false;

    #[ORM\Column(name: 'is_composer')]
    private bool $composer = false;

    #[ORM\Column(name: 'is_songwriter')]
    private bool $songwriter = false;

    #[ORM\Column(name: 'is_arranger')]
    private bool $arranger = false;

    #[ORM\Column(name: 'is_conductor')]
    private bool $conductor = false;

    #[ORM\Column(name: 'is_educator')]
    private bool $educator = false;

    #[ORM\Column(name: 'is_possessor')]
    private bool $possessor = false;

    #[ORM\Column(name: 'is_manager')]
    private bool $manager = false;

    #[ORM\Column(name: 'is_impresario')]
    private bool $impresario = false;

    #[ORM\OneToOne(targetEntity: Manager::class, mappedBy: 'user')]
    private ?Manager $managerDetails = null;

    #[ORM\OneToOne(targetEntity: Educator::class, mappedBy: 'user')]
    private ?Educator $educatorDetails = null;

    #[ORM\OneToOne(targetEntity: Singer::class, mappedBy: 'user')]
    private ?Singer $singerDetails = null;

    #[ORM\OneToOne(targetEntity: Possessor::class, mappedBy: 'user')]
    private ?Possessor $possessorDetails = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->instruments = new ArrayCollection();
        $this->genres = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function resetPassword(): static
    {
        $this->password = null;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getInstrument(): ?Instrument
    {
        return $this->instrument;
    }

    public function getInstrumentName(): ?string
    {
        return $this->instrument ? $this->instrument->getName() : null;
    }

    public function setInstrument(?Instrument $instrument): static
    {
        $this->instrument = $instrument;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): static
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isSinger(): ?bool
    {
        return $this->singer;
    }

    public function setSinger(bool $isSinger): static
    {
        $this->singer = $isSinger;

        return $this;
    }

    public function isComposer(): ?bool
    {
        return $this->composer;
    }

    public function setComposer(bool $isComposer): static
    {
        $this->composer = $isComposer;

        return $this;
    }

    public function isSongwriter(): ?bool
    {
        return $this->songwriter;
    }

    public function setSongwriter(bool $isSongwriter): static
    {
        $this->songwriter = $isSongwriter;

        return $this;
    }

    public function isArranger(): ?bool
    {
        return $this->arranger;
    }

    public function setArranger(bool $isArranger): static
    {
        $this->arranger = $isArranger;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    public function addInstrument(Instrument $instrument): static
    {
        if (!$this->instruments->contains($instrument)) {
            $this->instruments->add($instrument);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): static
    {
        $this->instruments->removeElement($instrument);

        return $this;
    }

    public function hasFeatures(): bool
    {
        return $this->isSinger()
            || $this->isSongwriter()
            || $this->isComposer()
            || $this->isArranger()
            || $this->isConductor()
            || $this->isEducator();
    }

    public function isConductor(): ?bool
    {
        return $this->conductor;
    }

    public function setConductor(bool $conductor): static
    {
        $this->conductor = $conductor;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function isEducator(): ?bool
    {
        return $this->educator;
    }

    public function setEducator(bool $educator): static
    {
        $this->educator = $educator;

        return $this;
    }

    public function isPossessor(): ?bool
    {
        return $this->possessor;
    }

    public function setPossessor(bool $possessor): static
    {
        $this->possessor = $possessor;

        return $this;
    }

    public function isManager(): ?bool
    {
        return $this->manager;
    }

    public function setManager(bool $manager): static
    {
        $this->manager = $manager;

        return $this;
    }

    public function isImpresario(): ?bool
    {
        return $this->impresario;
    }

    public function setImpresario(bool $impresario): static
    {
        $this->impresario = $impresario;

        return $this;
    }

    public function getManagerDetails(): ?Manager
    {
        return $this->managerDetails;
    }

    public function setManagerDetails(?Manager $managerDetails): static
    {
        if (null !== $managerDetails && $managerDetails->getUser() !== $this) {
            $managerDetails->setUser($this);
        }

        $this->managerDetails = $managerDetails;

        return $this;
    }

    public function getEducatorDetails(): ?Educator
    {
        return $this->educatorDetails;
    }

    public function setEducatorDetails(?Educator $educatorDetails): static
    {
        if (null !== $educatorDetails && $educatorDetails->getUser() !== $this) {
            $educatorDetails->setUser($this);
        }

        $this->educatorDetails = $educatorDetails;

        return $this;
    }

    public function getSingerDetails(): ?Singer
    {
        return $this->singerDetails;
    }

    public function setSingerDetails(?Singer $singerDetails): static
    {
        if (null !== $singerDetails && $singerDetails->getUser() !== $this) {
            $singerDetails->setUser($this);
        }

        $this->singerDetails = $singerDetails;

        return $this;
    }

    public function getPossessorDetails(): ?Possessor
    {
        return $this->possessorDetails;
    }

    public function setPossessorDetails(?Possessor $possessorDetails): static
    {
        if (null !== $possessorDetails && $possessorDetails->getUser() !== $this) {
            $possessorDetails->setUser($this);
        }

        $this->possessorDetails = $possessorDetails;

        return $this;
    }
}
