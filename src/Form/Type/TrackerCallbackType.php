<?php

namespace App\Form\Type;

use App\Form\Type\Callback\GameType;
use App\Form\Type\Callback\JobType;
use App\Form\Type\Callback\TrailerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

class TrackerCallbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'Game',
                GameType::class,
                [
                    'constraints' => [
                        new Valid()
                    ],
                    'allow_extra_fields' => true,
                ]
            )
            ->add(
                'Job',
                JobType::class,
                [
                    'constraints' => [
                        new Valid()
                    ],
                    'allow_extra_fields' => true,
                ]
            )
            ->add(
                'Trailer',
                TrailerType::class,
                [
                    'constraints' => [
                        new Valid()
                    ],
                    'allow_extra_fields' => true,
                ]
            );
    }
}
