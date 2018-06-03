<?php

namespace App\Form\Type\Callback;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'Income',
                NumberType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'DeadlineTime',
                DateTimeType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'widget' => 'single_text',
                ]
            )
            ->add(
                'SourceCity',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'SourceCompany',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'DestinationCity',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'DestinationCompany',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            );
    }

}
