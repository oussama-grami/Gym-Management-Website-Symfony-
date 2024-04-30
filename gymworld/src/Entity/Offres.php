<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffresRepository::class)]
class Offres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $duration = null;

    #[ORM\Column]
    private ?float $price = null;

    /**
     * @var Collection<int, OffreClient>
     */
    #[ORM\OneToMany(targetEntity: OffreClient::class, mappedBy: 'offre')]
    private Collection $offreClients;

    public function __construct()
    {
        $this->offreClients = new ArrayCollection();
    }

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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, OffreClient>
     */
    public function getOffreClients(): Collection
    {
        return $this->offreClients;
    }

    public function addOffreClient(OffreClient $offreClient): static
    {
        if (!$this->offreClients->contains($offreClient)) {
            $this->offreClients->add($offreClient);
            $offreClient->setOffre($this);
        }

        return $this;
    }

    public function removeOffreClient(OffreClient $offreClient): static
    {
        if ($this->offreClients->removeElement($offreClient)) {
            // set the owning side to null (unless already changed)
            if ($offreClient->getOffre() === $this) {
                $offreClient->setOffre(null);
            }
        }

        return $this;
    }




}
