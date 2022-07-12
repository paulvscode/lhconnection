<?php

namespace App\Form;

use App\Entity\SocialEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image')
            ->add('link')
            ->add('icon', ChoiceType::class, [
                'choices' => [
                    'Livre' => 'Livre',
                    'Ballon' => 'Ballon',
                    'Cloche' => 'Cloche',
                ]
            ])
            ->add('archived', ChoiceType::class, [
                'choices' => [
                    'Archivé' => true,
                    'Non-archivé' => false
            ],
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SocialEvent::class,
        ]);
    }
}