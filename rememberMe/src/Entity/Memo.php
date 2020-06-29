<?php

namespace App\Entity;

use App\Repository\MemoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=MemoRepository::class)
 */
class Memo
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="memos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @ORM\OneToMany(targetEntity=Shares::class, mappedBy="memo")
     */
    private $shares;

    public function __construct()
    {
        $this->shares = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|Shares[]
     */
    public function getShares(): Collection
    {
        return $this->shares;
    }

    public function addShare(Shares $share): self
    {
        if (!$this->shares->contains($share)) {
            $this->shares[] = $share;
            $share->setMemo($this);
        }

        return $this;
    }

    public function removeShare(Shares $share): self
    {
        if ($this->shares->contains($share)) {
            $this->shares->removeElement($share);
            // set the owning side to null (unless already changed)
            if ($share->getMemo() === $this) {
                $share->setMemo(null);
            }
        }

        return $this;
    }


}
