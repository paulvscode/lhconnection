<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, inversedBy="projects")
     */
    private $ProjectCategory;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="ProjectCategory")
     */
    private $projects;

    public function __construct()
    {
        $this->ProjectCategory = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(?string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getProjectCategory(): Collection
    {
        return $this->ProjectCategory;
    }

    public function addProjectCategory(self $projectCategory): self
    {
        if (!$this->ProjectCategory->contains($projectCategory)) {
            $this->ProjectCategory[] = $projectCategory;
        }

        return $this;
    }

    public function removeProjectCategory(self $projectCategory): self
    {
        $this->ProjectCategory->removeElement($projectCategory);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(self $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addProjectCategory($this);
        }

        return $this;
    }

    public function removeProject(self $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeProjectCategory($this);
        }

        return $this;
    }
}
