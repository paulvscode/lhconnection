<?php

namespace App\Controller\Admin;

use App\Entity\SocialEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SocialEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SocialEvent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            TextField::new('image', 'Lien image'),
            TextField::new('link', 'Redirection'),
            ChoiceField::new('icon', 'Icon')->setChoices([
                'Lunettes' => 'bi-eyeglasses',
                'Livre' => 'bi-book-fill',
                'Peinture' => 'bi-brush-fill',
                'Tchat' => 'ri-discuss-line'
            ])
        ];
    }
}
