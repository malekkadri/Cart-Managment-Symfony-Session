<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $nom_salle;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $description_salle;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $region_salle;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $adresse_salle;

    #[ORM\OneToMany(mappedBy: 'salle', targetEntity: Abonnement::class)]
    private $abonnements;

    public function __construct()
    {
        $this->abonnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getnom_salle(): ?string
    {
        return $this->nom_salle;
    }

    public function setNom_salle(string $nom_salle): self
    {
        $this->nom_salle = $nom_salle;

        return $this;
    }
    
    public function getnomSalle(): ?string
    {
        return $this->nom_salle;
    }

    public function setNomSalle(string $nom_salle): self
    {
        $this->nom_salle = $nom_salle;

        return $this;
    }

    public function getDescription_salle(): ?string
    {
        return $this->description_salle;
    }

    public function setDescription_salle(string $description_salle): self
    {
        $this->description_salle = $description_salle;

        return $this;
    }
    public function getDescriptionsalle(): ?string
    {
        return $this->description_salle;
    }

    public function setDescriptionsalle(string $description_salle): self
    {
        $this->description_salle = $description_salle;

        return $this;
    }

    public function getRegion_salle(): ?string
    {
        return $this->region_salle;
    }

    public function setRegion_salle(string $region_salle): self
    {
        $this->region_salle = $region_salle;

        return $this;
    }
    public function getRegionsalle(): ?string
    {
        return $this->region_salle;
    }

    public function setRegionsalle(string $region_salle): self
    {
        $this->region_salle = $region_salle;

        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAdresse_salle(): ?string
    {
        return $this->adresse_salle;
    }

    public function setAdressesalle(string $adresse_salle): self
    {
        $this->adresse_salle = $adresse_salle;

        return $this;
    }
    public function getAdressesalle(): ?string
    {
        return $this->adresse_salle;
    }

        

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): self
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements[] = $abonnement;
            $abonnement->setSalle($this);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): self
    {
        if ($this->abonnements->removeElement($abonnement)) {
            // set the owning side to null (unless already changed)
            if ($abonnement->getSalle() === $this) {
                $abonnement->setSalle(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->nom_salle ?? 'Unnamed Salle';
    }
  

}
