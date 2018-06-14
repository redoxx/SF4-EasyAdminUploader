<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CodesCsvFileRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class CodesCsvFile
{
    /**
     * Class CodesCsvFile
     *
     * @author Red
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign", inversedBy="codesFiles")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $campaign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $csvfile;

    /**
     * @Vich\UploadableField(mapping="campaign_codes", fileNameProperty="csvfile")
     * @var File $csvcodesfile
     */
    private $csvcodesfile;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $processed;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $start_process_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_process_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_lines_processed;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->nbr_lines_processed = 0;
        $this->processed = FALSE;
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set campaign.
     *
     * @param \App\Entity\Campaign $campaign
     *
     * @return CodesCsvFile
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign.
     *
     * @return \App\Entity\Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }


    public function getCsvfile(): ?string
    {
        return $this->csvfile;
    }

    public function setCsvfile(string $csvfile): self
    {
        $this->csvfile = $csvfile;

        return $this;
    }

    /**
     * Set Csvcodesfile
     *
     * @param File $csvcodesfile
     *
     * @return $this
     */
    public function setCsvcodesfile(File $csvcodesfile)
    {
        $this->csvcodesfile = $csvcodesfile;
        return $this;
    }

    /**
     * Get Csvcodesfile
     *
     * @return File
     */
    public function getCsvcodesfile()
    {
        return $this->csvcodesfile;
    }


    public function getProcessed(): ?bool
    {
        return $this->processed;
    }

    public function setProcessed(bool $processed): self
    {
        $this->processed = $processed;

        return $this;
    }

    public function getStartProcessAt(): ?\DateTimeInterface
    {
        return $this->start_process_at;
    }

    public function setStartProcessAt(\DateTimeInterface $start_process_at): self
    {
        $this->start_process_at = $start_process_at;

        return $this;
    }

    public function getEndProcessAt(): ?\DateTimeInterface
    {
        return $this->end_process_at;
    }

    public function setEndProcessAt(\DateTimeInterface $end_process_at): self
    {
        $this->end_process_at = $end_process_at;

        return $this;
    }

    public function getNbrLinesProcessed(): ?string
    {
        return $this->nbr_lines_processed;
    }

    public function setNbrLinesProcessed(string $nbr_lines_processed): self
    {
        $this->nbr_lines_processed = $nbr_lines_processed;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /** 
     * @ORM\PostPersist 
     */
    public function uploadCsvS3AWS()
    {
        
    }
}
