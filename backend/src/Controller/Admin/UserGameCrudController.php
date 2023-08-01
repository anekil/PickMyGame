<?php

namespace App\Controller\Admin;

use App\Entity\UserGame;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserGameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserGame::class;
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
