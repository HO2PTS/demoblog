<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //l'objet $builder permet de créer un formulaire
        //la méthode add() permet d'ajouter un champ au formulaire 
        $builder
            ->add('title')
            ->add('content') //Je modifie le champs content en tant que input de type text
            ->add('image')
            ->add('category', EntityType::class, [ //on indique qu'il faut récupérer les catégorie dans une entity 
                'class'=> Category::class, //onprécise le nom dans une entity
                'choice_label' => 'title' // on indique quoi afficher à l'utilisateur
            ])
            //->add('createAt')
            // nous commentons ce champs car la date d'ajout sera ajoutée automatiquement lors de l'insertion de l'article
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
