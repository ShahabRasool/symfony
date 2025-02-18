<?php

namespace App\Form;

use App\Entity\Emploee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('fathername')
            ->add('manager', EntityType::class, [
                'class' => Emploee::class,
                'choice_label' => 'name',
                'placeholder'=> 'Please select the manager'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emploee::class,
        ]);
    }
}
