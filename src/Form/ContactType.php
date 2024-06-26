<?php
// src/Form/ContactType.php

namespace App\Form;

use App\Entity\Contact;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'contact.formPlaceHolderName', 'class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'contact.formPlaceHolderEmail', 'class' => 'form-control'],
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'contact.formPlaceHolderTel', 'class' => 'form-control'],
            ])
            ->add('topic', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'contact.formPlaceHolderTopic', 'class' => 'form-control'],
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'contact.formPlaceHolderText', 'class' => 'form-control', 'style' => 'height:150px;'],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'contact.formButton',
                'attr' => ['class' => 'btn btn-primary px-5 py-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
