<?php

namespace App\Entity;

use App\Repository\SharesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SharesRepository::class)
 */
class Shares
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shares_dest")
     */
    private $dest;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shares_src")
     * @ORM\JoinColumn(nullable=false)
     */
    private $src;

    /**
     * @ORM\ManyToOne(targetEntity=Memo::class, inversedBy="shares")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memo;

    public function __construct()
    {
        $this->memo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDest(): ?User
    {
        return $this->dest;
    }

    public function setDest(?User $dest): self
    {
        $this->dest = $dest;

        return $this;
    }

    public function getSrc(): ?User
    {
        return $this->src;
    }

    public function setSrc(?User $src): self
    {
        $this->src = $src;

        return $this;
    }

    public function getMemo(): ?Memo
    {
        return $this->memo;
    }

    public function setMemo(?Memo $memo): self
    {
        $this->memo = $memo;

        return $this;
    }


}
