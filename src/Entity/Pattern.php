<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatternRepository")
 */
class Pattern
{

    public static $PATTERN_TYPE_INCL = 'INCLUDE';
    public static $PATTERN_TYPE_EXCL = 'EXCLUDE';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25, nullable=false, options={"default"="INCLUDE"})
     */
    private $type = 'INCLUDE';

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $metadata;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=false)
     */
    private $parameters = [];

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="patterns")
     */
    private $job;

    /**
     * get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set Id
     *
     * @param mixed $id
     *
     * @return $this
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * get Type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * set Type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * get Metadata
     *
     * @return string
     */
    public function getMetadata(): string
    {
        return $this->metadata;
    }

    /**
     * set Metadata
     *
     * @param string $metadata
     *
     * @return $this
     */
    public function setMetadata(string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * get Parameters
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * set Parameters
     *
     * @param array $parameters
     *
     * @return $this
     */
    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * get Job
     *
     * @return Job
     */
    public function getJob(): Job
    {
        return $this->job;
    }

    /**
     * set Job
     *
     * @param mixed $job
     *git
     * @return $this
     */
    public function setJob($job): self
    {
        $this->job = $job;

        return $this;
    }
}
