<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[Assert\Callback(callback: 'validateDates')]
#[Assert\Callback(callback: 'validateStartDate')]
#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $duree_abonnement;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $prix_abonnement;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $date_deb_abonnement;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $date_fin_abonnement;

    #[ORM\ManyToOne(targetEntity: Salle::class, inversedBy: 'abonnements')]
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDureeAbonnement(): ?string
    {
        return $this->duree_abonnement;
    }

    public function setDureeAbonnement(string $duree_abonnement): self
    {
        $this->duree_abonnement = $duree_abonnement;

        return $this;
    }
    public function getDuree_Abonnement(): ?string
    {
        return $this->duree_abonnement;
    }

    public function setDuree_Abonnement(string $duree_abonnement): self
    {
        $this->duree_abonnement = $duree_abonnement;

        return $this;
    }

    public function getPrixAbonnement(): ?string
    {
        return $this->prix_abonnement;
    }

    public function setPrixAbonnement(string $prix_abonnement): self
    {
        $this->prix_abonnement = $prix_abonnement;

        return $this;
    }
    public function getPrix_Abonnement(): ?string
    {
        return $this->prix_abonnement;
    }

    public function setPrix_Abonnement(string $prix_abonnement): self
    {
        $this->prix_abonnement = $prix_abonnement;

        return $this;
    }


    public function getDateDebAbonnement(): ?\DateTimeInterface
    {
        return $this->date_deb_abonnement;
    }

    public function setDateDebAbonnement(\DateTimeInterface $date_deb_abonnement): self
    {
        $this->date_deb_abonnement = $date_deb_abonnement;

        return $this;
    }

    public function getDateFinAbonnement(): ?\DateTimeInterface
    {
        return $this->date_fin_abonnement;
    }

    public function setDateFinAbonnement(\DateTimeInterface $date_fin_abonnement): self
    {
        $this->date_fin_abonnement = $date_fin_abonnement;

        return $this;
    }
    public function getDateDeb_Abonnement(): ?\DateTimeInterface
    {
        return $this->date_deb_abonnement;
    }

    public function setDateDeb_Abonnement(\DateTimeInterface $date_deb_abonnement): self
    {
        $this->date_deb_abonnement = $date_deb_abonnement;

        return $this;
    }

    public function getDateFin_Abonnement(): ?\DateTimeInterface
    {
        return $this->date_fin_abonnement;
    }

    public function setDateFin_Abonnement(\DateTimeInterface $date_fin_abonnement): self
    {
        $this->date_fin_abonnement = $date_fin_abonnement;

        return $this;
    }
    public function getDate_Deb_Abonnement(): ?\DateTimeInterface
    {
        return $this->date_deb_abonnement;
    }

    public function setDate_Deb_Abonnement(\DateTimeInterface $date_deb_abonnement): self
    {
        $this->date_deb_abonnement = $date_deb_abonnement;

        return $this;
    }

    public function getDate_Fin_Abonnement(): ?\DateTimeInterface
    {
        return $this->date_fin_abonnement;
    }

    public function setDate_Fin_Abonnement(\DateTimeInterface $date_fin_abonnement): self
    {
        $this->date_fin_abonnement = $date_fin_abonnement;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
    public function validateDates(ExecutionContextInterface $context, $payload)
    {
        if ($this->date_deb_abonnement >= $this->date_fin_abonnement) {
            $context->buildViolation('The start date must be before the end date.')
                ->atPath('date_deb_abonnement')
                ->addViolation();
        }
    }
    public function validateStartDate(ExecutionContextInterface $context, $payload)
    {
        $yesterday = new \DateTime('yesterday');
        
        if ($this->date_deb_abonnement <= $yesterday) {
            $context->buildViolation('The start date must be after yesterday.')
                ->atPath('date_deb_abonnement')
                ->addViolation();
        }
    }
}
