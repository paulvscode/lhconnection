<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('sortTitle', 'Sous-titre'),
            TextEditorField::new('description', 'Description'),
            TextEditorField::new('longDescription', 'Description longue'),
            TextField::new('image', 'Lien image'),
            TextField::new('link', 'Redirection'),
            DateField::new('createdAt', 'Date de création'),
            ChoiceField::new('filterSortTitle', 'Filtre')->setChoices([
                'Southampton' => 'filter-web',
                'Le Havre' => 'filter-app',
                'Tampa' => 'filter-card'
                ])
            ];
    }
}
