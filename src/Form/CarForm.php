<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarForm extends AbstractType
{
    public function createCarForm(FormBuilderInterface $formBuilder, array $options): void
    {
        $formBuilder
            ->add('name', TextType::class)
            ->add('brand', TextType::class)
            ->add('price', IntegerType::class)
            ->add('thumb', FileType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('Add', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
