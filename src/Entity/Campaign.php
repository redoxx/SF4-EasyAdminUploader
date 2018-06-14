<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Campaign
 *
 * @author Red
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Campaign
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
    private $title;


    /**
     * @ORM\Column(type="datetime")
     */
    private $s_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $e_date;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CodesCsvFile", mappedBy="campaign", cascade={"persist","remove"}, orphanRemoval=true)
    * @var \Doctrine\Common\Collections\Collection
    */
    protected $codesFiles;

    /**
     * @ORM\Column(type="text")
     */
    private $promotext;

    /**
     * It only stores the name of the image associated with the campaign.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $image;
    
    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the campaign.
     *
     * @Vich\UploadableField(mapping="campaign_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;


     /**
     * @ORM\Column(type="boolean")
     */
    private $draft;


    /**
     * Indicate if the campaign is enabled .
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->codesFiles = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getId()
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

    public function getSDate(): ?\DateTimeInterface
    {
        return $this->s_date;
    }

    public function setSDate(\DateTimeInterface $s_date): self
    {
        $this->s_date = $s_date;

        return $this;
    }

    public function getEDate(): ?\DateTimeInterface
    {
        return $this->e_date;
    }

    public function setEDate(\DateTimeInterface $e_date): self
    {
        $this->e_date = $e_date;

        return $this;
    }

    public function getPromotext(): ?string
    {
        return $this->promotext;
    }

    public function setPromotext(string $promotext): self
    {
        $this->promotext = $promotext;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            //$this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Add CodesFile
     *
     * @param \App\Entity\CodesCsvFile $codesfile
     *
     * @return Campaign
     */
    public function addCodesFile(CodesCsvFile $codesfile){
        $this->codesFiles[] = $codesfile;
        $codesfile->setCampaign($this);

        return $this;
    }

     /**
     * Remove CodesFile.
     *
     * @param \App\Entity\CodesFile $codesfile
     */
     public function removeCodesFile(CodesCsvFile $codesfile)
     {
         $this->codesfiles->removeElement($codesfile);
     }

     /**
     * Get CodesFiles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
     public function getCodesFiles()
     {
         return $this->codesFiles;
     }



    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

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

    public function getDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    public function __toString() {
        return $this->title;
    }
}
