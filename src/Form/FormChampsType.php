<?php

namespace App\Form;

use App\Entity\FormChamps;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormChampsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('question')
            ->add('description')
            ->add('actif', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,

                ],
                'expanded' => true,
            ])
            ->add('projet')
            ->add('formToTaux')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormChamps::class,
        ]);
    }
}
