<?php

namespace App\Form;

use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('name', TextType::class)
        ->add('father_name',TextType::class)
        ->add('email', EmailType::class)
        ->add('address', TextareaType::class)
        ->add('phone', TextType::class)
        ->add('d_b_birth', DateTimeType::class)
        ->add('save', SubmitType::class, ['label' => 'Add Teacher']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
     $resolver->setDefaults([
        'data_class'=> Teacher::class,
     ]);   
    }
}