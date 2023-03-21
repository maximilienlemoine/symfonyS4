<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Fournisseur;
use App\Repository\FournisseurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $codePostal = $options['codePostal'];
        $builder
            ->add('designation', TextType::class, [
                'attr' => ['class' => 'form-item']
            ])
            ->add('description',TextType::class, [
                'attr' => ['class' => 'form-item']
            ])
            ->add('prix',NumberType::class, [
                'attr' => ['class' => 'form-item']
            ])
            ->add('quantiteDisponible', IntegerType::class, [
                'attr' => ['class' => 'form-item']
            ])
            ->add('fournisseur', EntityType::class, [
                'attr' => ['class' => 'form-item'],
                'class' => Fournisseur::class,
                'choice_label' => 'libelle',
                'query_builder' => function(FournisseurRepository $fr) use ($codePostal){
                    return $fr->createQueryBuilder('f')
                        ->join('f.adresse', 'a')
                        ->where('a.codePostal = :codePostal')
                        ->setParameter('codePostal', $codePostal);
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'codePostal' => null,
        ]);
    }
}
