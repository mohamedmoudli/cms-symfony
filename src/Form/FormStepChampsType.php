<?php

namespace App\Form;

use App\Entity\FormStepChamps;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormStepChampsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ordre')
            ->add('actif', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,

                ],
                'expanded' => true,
            ])
            ->add('obligatoire', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,

                ],
                'expanded' => true,
            ])
            ->add('formStep')
            ->add('formChamps')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormStepChamps::class,
        ]);
    }
}
