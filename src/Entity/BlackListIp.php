<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlackListIpRepository")
 */
class BlackListIp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ip;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId()
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->Ip;
    }

    public function setIp(string $Ip): self
    {
        $this->Ip = $Ip;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
