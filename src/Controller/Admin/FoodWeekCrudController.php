<?php

namespace App\Controller\Admin;

use App\Entity\FoodWeek;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FoodWeekCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FoodWeek::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           AssociationField::new('monday', 'Pondelok')
               ->renderAsEmbeddedForm(FoodDayCrudController::class)
               ->setColumns(12)
               ->addCssClass('text-large text-bold'),

           AssociationField::new('tuesday', 'Utorok')
               ->renderAsEmbeddedForm(FoodDayCrudController::class)
               ->setColumns(12),

           AssociationField::new('wednesday', 'Streda')
               ->renderAsEmbeddedForm(FoodDayCrudController::class)
               ->setColumns(12),

           AssociationField::new('thursday', 'Stvrtok')
               ->renderAsEmbeddedForm(FoodDayCrudController::class)
               ->setColumns(12),

           AssociationField::new('friday', 'Piatok')
               ->renderAsEmbeddedForm(FoodDayCrudController::class)
               ->setColumns(12),
        ];
    }

}
