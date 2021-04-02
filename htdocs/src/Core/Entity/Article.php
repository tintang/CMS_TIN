<?php


namespace App\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * Class Article
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class Article implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePrice::class, mappedBy="article", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $articlePrices;

    public function __construct()
    {
        $this->articlePrices = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ArticlePrice[]
     */
    public function getArticlePrices(): Collection
    {
        return $this->articlePrices;
    }

    public function addArticlePrice(ArticlePrice $articlePrice): self
    {
        if (!$this->articlePrices->contains($articlePrice)) {
            $this->articlePrices[] = $articlePrice;
            $articlePrice->setArticle($this);
        }

        return $this;
    }

    public function removeArticlePrice(ArticlePrice $articlePrice): self
    {
        if ($this->articlePrices->removeElement($articlePrice)) {
            // set the owning side to null (unless already changed)
            if ($articlePrice->getArticle() === $this) {
                $articlePrice->setArticle(null);
            }
        }

        return $this;
    }
}