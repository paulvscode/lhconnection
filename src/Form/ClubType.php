<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Titre'])
            ->add('description', null, ['label' => 'Description'])
            ->add('longDescription', null, ['label' => 'Description complète'])
            ->add('imageFile', VichImageType::class)
            ->add('createdAt', null, ['label' => 'Créé le'])
            ->add('archived', ChoiceType::class, [
                'choices' => [
                    'Non-archivé' => false,
                    'Archivé' => true
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
