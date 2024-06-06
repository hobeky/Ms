<?php

namespace App\Controller\Admin;

use App\Entity\Food;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FoodCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Food::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(12),
            TextField::new('title'),
            FormField::addColumn(12),
            TextField::new('description'),
            FormField::addColumn(12),
            TextField::new('alergens'),
        ];
    }

}
