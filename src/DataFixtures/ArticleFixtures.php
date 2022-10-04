<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       /* for($i = 1; $i <= 10; $i++)
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
        }*/

        $faker = \Faker\Factory::create('fr_FR');
        // créer 3 catégories

        for ($i=1; $i <= 3 ; $i++) { 
            $category = new Category;
            $category->setTitle($faker->sentence(3, false)); //renvoie 3 mots aléatoires avec false si on ne veut pas que ce soit variables
            $manager->persist($category);
            for($j = 1; $j <= mt_rand(4, 6); $j++) { // permet de créer avec la méthode mt_rand entre 4 et 6 articles aléatoires parmis les arguments donc 4 & 6
                $article = new Article;

                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>'; // join() => prend en param un séparateur,dans l'exemple => ('</p><p>') et un tableau et renvoie une chaîne de caratère.

                $article ->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreateAt($faker->dateTimeBetween("-6 months"))
                        ->setCategory($category); 
                $manager->persist($article);

                for ($k=1; $k <= mt_rand(5, 10) ; $k++) { //créer entre 5 et 10 commentaires par article
                    $comment = new Comment;

                    $content = '<p>' . join('</p><p>', $faker->paragraphs(2)) . '</p>';

                    $now = new \DateTime; //récupération de la date d'aujourd'hui

                    $interval = $now->Diff($article->getCreateAt()); //intervalle entre aujourd'hui et la date de création de l'arctile

                    $days = $interval->days; //on récupère l'intervalle en jours

                    $comment
                            ->setContent($content)
                            ->setCreatedAT($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article);
                    $manager->persist($comment);

                }
            }
        }
        $manager->flush();
        // flush() permet d'exécuter la requête SQL préparée grâce à persist()
    } 
}
