<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class EventCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly ParameterBagInterface $parameterBag
    )
    {

    }
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // ID is automatically generated, hide it on forms
            TextField::new('title', 'Event Title'),
            ImageField::new('image')->setBasePath('/image/medium/')->setUploadDir($this->parameterBag->get('img_dir') . 'original'),
            TextareaField::new('text', 'Description')
                ->setHelp('Enter the detailed description of the event here.'), // Providing context for the input field
            TextField::new('place', 'Event Location'),
            DateTimeField::new('dateFrom', 'Start Date')
                ->setFormTypeOptions([
                    'html5' => true,
                    'years' => range(date('Y'), date('Y') + 10),
                    'widget' => 'single_text'
                ]),
            DateTimeField::new('dateTo', 'End Date')
                ->setFormTypeOptions([
                    'html5' => true,
                    'years' => range(date('Y'), date('Y') + 10),
                    'widget' => 'single_text'
                ]),
        ];
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
