<?php

namespace App\Controller\Admin;

use App\Entity\FoodDay;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FoodDayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FoodDay::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(12),
            DateField::new('day'),
            FormField::addColumn(3),
            AssociationField::new('breakfast')->renderAsEmbeddedForm(FoodCrudController::class),
            FormField::addColumn(3),
            AssociationField::new('snack1')->renderAsEmbeddedForm(FoodCrudController::class),
            FormField::addColumn(3),
            AssociationField::new('lunch')->renderAsEmbeddedForm(FoodCrudController::class),
            FormField::addColumn(3),
            AssociationField::new('snack2')->renderAsEmbeddedForm(FoodCrudController::class),

            ];
    }

}
