<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i <5; $i++){
            $category = new Category();
            $category->setNom("article $i");
            $category->setDescription("Le contenu $i");

            $manager->persist($category);

            for($j=1; $j <=2 ; $j++){
                $article = new Article();
                $article->setNom("article $j")
                   ->setContenu("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.")
                   ->setDateDeCreation(new \DateTime())
                   ->setCategory($category);

                $manager->persist($article);
            }
            $manager->flush();
        }
        $manager->flush();
    }
}
