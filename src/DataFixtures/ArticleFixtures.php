<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++)
        {
            $article = new Article;
            //on instancie ma classe article qui se trouve dans le dossier App\Entity
            //Nous pouvons maintenant faire appel au setters pour insérer les données
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p> Contenue de l'article n°$i </p>")
                    ->setImage("http://picsum.photos/250/150")
                    ->setCreateAt(new \DateTime); //j'instancie la classe DateTime pour récupérer la date d'aujourd'hui. Le dateTime se trouve en dehors du fichier alors il faut le backslash pour sortir. Sinon on peut mettre dans le haut du script use Datetime
            $manager->persist($article);
            //persist() permet de faire persister l'article dans le temps et péparer son insertion en BDD
        }
        $manager->flush();
        // flush() permet d'exécuter la requête SQL préparée grâce à persist()
    }
}
