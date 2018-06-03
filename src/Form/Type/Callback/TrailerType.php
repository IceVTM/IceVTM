<?php

namespace App\Form\Type\Callback;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class TrailerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'Wear',
                NumberType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'Name',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            );
    }
}
