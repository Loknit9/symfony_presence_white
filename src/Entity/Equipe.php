<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $categorieAge = null;

    #[ORM\Column(length: 20)]
    private ?string $categorieGenre = null;

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
        $this->users = new ArrayCollection();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCategorieAge(): ?int
    {
        return $this->categorieAge;
    }

    public function setCategorieAge(int $categorieAge): static
    {
        $this->categorieAge = $categorieAge;

        return $this;
    }

    public function getCategorieGenre(): ?string
    {
        return $this->categorieGenre;
    }

    public function setCategorieGenre(string $categorieGenre): static
    {
        $this->categorieGenre = $categorieGenre;

        return $this;
    }
}
