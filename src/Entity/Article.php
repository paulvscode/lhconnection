<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $Image;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="articles")
     */
    private $ArticleCategories;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="ArticleCategories")
     */
    private $articles;

    public function __construct()
    {
        $this->ArticleCategories = new ArrayCollection();
        $this->articles = new ArrayCollection();
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
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getArticleCategories(): Collection
    {
        return $this->ArticleCategories;
    }

    public function addArticleCategory(self $articleCategory): self
    {
        if (!$this->ArticleCategories->contains($articleCategory)) {
            $this->ArticleCategories[] = $articleCategory;
        }

        return $this;
    }

    public function removeArticleCategory(self $articleCategory): self
    {
        $this->ArticleCategories->removeElement($articleCategory);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(self $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addArticleCategory($this);
        }

        return $this;
    }

    public function removeArticle(self $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeArticleCategory($this);
        }

        return $this;
    }
}
