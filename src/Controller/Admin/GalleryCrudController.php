<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class GalleryCrudController extends AbstractCrudController
{

    public function __construct(
        private readonly ParameterBagInterface $parameterBag
    )
    {

    }
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('title')
                ->renderAsEmbeddedForm(TranslationCrudController::class)
                ->setColumns(12),
            DateField::new('happenedAt')
                ->setColumns(6),
            BooleanField::new('isVisible')
                ->setColumns(6),
            ImageField::new('images')
                ->setBasePath('/image/medium/')
                ->setUploadDir($this->parameterBag->get('img_dir') . '/original')
                ->setFormTypeOptions(['multiple' => true])
                ->setColumns(12),
            TextField::new('youtubeUrl')
                ->setLabel('Youtube Link')
                ->setColumns(12),
        ];
    }
}
