<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\Column(length: 255)]
    private ?string $typeEvenement = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Presence::class, orphanRemoval: true)]
    private Collection $presences;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: EquipeEvenement::class, orphanRemoval: true)]
    private Collection $equipeEvenements;

    public function hydrate (array $vals){
        foreach ($vals as $cle => $valeur){
            if (isset ($vals[$cle])){
                $nomSet = "set" . ucfirst($cle);
                $this->$nomSet ($valeur);
            }
        }
    }

    public function __construct(array $init =[])
    {
        $this->hydrate($init);
        $this->presences = new ArrayCollection();
        $this->equipeEvenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(\DateTimeInterface $dateEvenement): static
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getTypeEvenement(): ?string
    {
        return $this->typeEvenement;
    }

    public function setTypeEvenement(string $typeEvenement): static
    {
        $this->typeEvenement = $typeEvenement;

        return $this;
    }

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): static
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setEvenement($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getEvenement() === $this) {
                $presence->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EquipeEvenement>
     */
    public function getEquipeEvenements(): Collection
    {
        return $this->equipeEvenements;
    }

    public function addEquipeEvenement(EquipeEvenement $equipeEvenement): static
    {
        if (!$this->equipeEvenements->contains($equipeEvenement)) {
            $this->equipeEvenements->add($equipeEvenement);
            $equipeEvenement->setEvenement($this);
        }

        return $this;
    }

    public function removeEquipeEvenement(EquipeEvenement $equipeEvenement): static
    {
        if ($this->equipeEvenements->removeElement($equipeEvenement)) {
            // set the owning side to null (unless already changed)
            if ($equipeEvenement->getEvenement() === $this) {
                $equipeEvenement->setEvenement(null);
            }
        }

        return $this;
    }

}
