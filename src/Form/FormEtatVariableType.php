<?php

namespace App\Form;

use App\Entity\FormEtatVariable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormEtatVariableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('nomVariable')

            ->add('typeInput', ChoiceType::class, [
                'choices' => [
                    'text' => 'text',
                    'tel' => 'tel',
                    'list' => 'list',
                    'radio' => 'radio',
                    'checkbox' => 'checkbox',
                    'email' => 'email',
                    'number' => 'number',
                    'textarea' => 'textarea',
                    'password' => 'password',
                    'ical_hour' => 'ical_hour',
                    'ical_night' => 'ical_night',
                    'ical_day' => 'ical_day'

                ]
            ])
            ->add('valeur')
            ->add('formEtat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormEtatVariable::class,
        ]);
    }
}
