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
            TextField::new('name'),
            AssociationField::new('position')->renderAsEmbeddedForm(TranslationCrudController::class),
            AssociationField::new('description')->renderAsEmbeddedForm(TranslationCrudController::class),
            ImageField::new('image')->setBasePath('/images/')->setUploadDir($this->parameterBag->get('img_dir') . 'original'),
        ];
    }

}
