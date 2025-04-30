<?php

namespace App\Form;

use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ReviewType extends AbstractType
{
    public function __construct(
        private readonly TranslatorInterface $translator
    )
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nick', TextType::class, [
                'label' => $this->translator->trans('review.formPlaceholderName')
            ])
            ->add('reviewText', TextareaType::class, [
                'label' => $this->translator->trans('review.formPlaceholderReview')
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage',
                'constraints' => new Recaptcha3([
                    'message' => 'There were problems with your captcha. Please try again or contact with support
                                    and provide following code(s): {{ errorCodes }}'
                ]),
            ])
            ->add('stars', ChoiceType::class, [
            'choices'  => [
                '1 Star' => 1,
                '2 Stars' => 2,
                '3 Stars' => 3,
                '4 Stars' => 4,
                '5 Stars' => 5,
            ],
            'expanded' => true,
            'multiple' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your default options here
        ]);
    }
}

