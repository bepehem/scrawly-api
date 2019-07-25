<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"poll"}})
 * @ApiFilter(SearchFilter::class, properties={"slug":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\PollRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Poll
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"poll"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"poll"})
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"poll"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Person", mappedBy="poll", orphanRemoval=true)
     * @Groups({"poll"})
     */
    private $person;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Choice", mappedBy="poll", orphanRemoval=true)
     * @Groups({"poll"})
     */

    private $choice;

    public function __construct()
    {
        $this->person = new ArrayCollection();
        $this->choice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPerson(): Collection
    {
        return $this->person;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->person->contains($person)) {
            $this->person[] = $person;
            $person->setPoll($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->person->contains($person)) {
            $this->person->removeElement($person);
            // set the owning side to null (unless already changed)
            if ($person->getPoll() === $this) {
                $person->setPoll(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Choice[]
     */
    public function getChoice(): Collection
    {
        return $this->choice;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choice->contains($choice)) {
            $this->choice[] = $choice;
            $choice->setPoll($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choice->contains($choice)) {
            $this->choice->removeElement($choice);
            // set the owning side to null (unless already changed)
            if ($choice->getPoll() === $this) {
                $choice->setPoll(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->setCreatedAt(new \DateTime());
    }
}
