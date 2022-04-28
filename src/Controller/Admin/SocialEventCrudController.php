<?php

namespace App\Controller\Admin;

use App\Entity\SocialEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SocialEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SocialEvent::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
