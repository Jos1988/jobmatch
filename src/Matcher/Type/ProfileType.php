<?php

namespace App\Matcher\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Created by PhpStorm.
 * User: Jos
 * Date: 2-4-2018
 * Time: 17:14
 */
class ProfileType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'IE',
                IntegerType::class,
                [
                    'required' => false,
                    'attr' => ['min' => 0, 'max' => 10],
                    'label' => 'Extraversie (IE)',
                ]
            )
            ->add(
                'SN',
                IntegerType::class,
                [
                    'required' => false,
                    'attr' => ['min' => 0, 'max' => 10],
                    'label' => 'Openheid (SN)',
                ]
            )
            ->add(
                'TF',
                IntegerType::class,
                [
                    'required' => false,
                    'attr' => ['min' => 0, 'max' => 10],
                    'label' => 'Vriendelijkheid (TF)',
                ]
            )
            ->add(
                'PJ',
                IntegerType::class,
                [
                    'required' => false,
                    'attr' => ['min' => 0, 'max' => 10],
                    'label' => 'Ordelijkheid (PJ)',
                ]
            )
            ->add(
                'TS',
                IntegerType::class,
                [
                    'required' => false,
                    'attr' => ['min' => 0, 'max' => 10],
                    'label' => 'Stabiliteit (TD)',
                ]
            )
            ->add(
                'MHW',
                ChoiceType::class,
                [
                    'label' => 'opleidings niveau',
                    'required' => false,
                    'choices' => [
                        'Middelbaar onderwijs (0)' => 0,
                        'Hoger onderwijs (1)' => 1,
                        'Wetenschappelijk onderwijs (2)' => 2,
                    ],
                ]
            )
            ->add('submit', SubmitType::class);
    }
}