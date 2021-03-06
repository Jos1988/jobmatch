<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Pattern", mappedBy="job")
     */
    private $patterns;

    /**
     * Job constructor.
     */
    public function __construct()
    {
        $this->patterns = new ArrayCollection();
    }

    /**
     * get Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * set Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * get Description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * set Description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * get Patterns
     *
     * @return mixed
     */
    public function getPatterns()
    {
        return $this->patterns;
    }

    /**
     * set Patterns
     *
     * @param mixed $patterns
     *
     * @return $this
     */
    public function setPatterns($patterns): self
    {
        $this->patterns = $patterns;

        return $this;
    }

    /**
     * @param Pattern $pattern
     *
     * @return $this
     */
    public function addPattern(Pattern $pattern): self
    {
        if (false === $this->patterns->contains($pattern)) {
            $this->patterns->add($pattern);
        }

        return $this;
    }
}
