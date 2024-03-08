<?php

namespace App\Form;

use App\Entity\FormStep;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormStepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('ordre')
            ->add('actif', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,

                ],
                'expanded' => true,
            ])
            ->add('save', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,

                ],
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormStep::class,
        ]);
    }
}
