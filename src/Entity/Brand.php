<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Model; // Ensure you have the correct namespace for your Model entity

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $CountryOfManufacture = null;

    #[ORM\Column(length: 255)]
    private ?string $ManufactureName = null;

    #[ORM\Column(length: 255)]
    private ?string $Models = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'brand')]
    private Collection $models;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCountryOfManufacture(): ?string
    {
        return $this->CountryOfManufacture;
    }

    public function setCountryOfManufacture(string $CountryOfManufacture): static
    {
        $this->CountryOfManufacture = $CountryOfManufacture;

        return $this;
    }

    public function getManufactureName(): ?string
    {
        return $this->ManufactureName;
    }

    public function setManufactureName(string $ManufactureName): static
    {
        $this->ManufactureName = $ManufactureName;

        return $this;
    }

    public function getModels(): ?string
    {
        return $this->Models;
    }

    public function setModels(string $Models): static
    {
        $this->Models = $Models;

        return $this;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}