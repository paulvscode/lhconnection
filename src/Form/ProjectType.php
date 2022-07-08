<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Responsible;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('longDescription', null, ['label' => 'Complete description'])
            ->add('image')
            ->add('link')
            ->add('filterSortTitle')
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
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
