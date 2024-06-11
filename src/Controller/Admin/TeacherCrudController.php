<?php

namespace App\Controller\Admin;

use App\Entity\Teacher;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TeacherCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly ParameterBagInterface $parameterBag
    )
    {

    }
    public static function getEntityFqcn(): string
    {
        return Teacher::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setColumns(12),
            AssociationField::new('position')
                ->renderAsEmbeddedForm(TranslationCrudController::class)
                ->setColumns(12),
            AssociationField::new('description')
                ->renderAsEmbeddedForm(TranslationCrudController::class)
                ->setColumns(12),
            ImageField::new('image')
                ->setBasePath('/image/medium/')
                ->setUploadDir($this->parameterBag->get('img_dir') . 'original')
                ->setColumns(12),
        ];
    }

}
