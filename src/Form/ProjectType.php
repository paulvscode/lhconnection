<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Responsible;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('longDescription', null, ['label' => 'Description complète'])
            ->add('imageFile', VichImageType::class)
            ->add('link')
            ->add('filterSortTitle', null, ['label' => 'Mots clés'])
            ->add('sortTitle', ChoiceType::class, [
                'choices' => [
                    'Private' => true,
                    'Public' => false,
                ],
            ])
            ->add('responsibles', EntityType::class, [
                'class' => Responsible::class,
                'mapped' => true,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('archived', ChoiceType::class, [
                    'choices' => [
                        'Non-archivé' => false,
                        'Archivé' => true
                    ]]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
