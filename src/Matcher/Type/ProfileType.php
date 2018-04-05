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
            ->add('IE', IntegerType::class, ['attr' => ['min' => 0, 'max' => 10], 'label' => 'Extraversie (IE)'])
            ->add('SN', IntegerType::class, ['attr' => ['min' => 0, 'max' => 10], 'label' => 'Openheid (SN)'])
            ->add('TF', IntegerType::class, ['attr' => ['min' => 0, 'max' => 10], 'label' => 'Vriendelijkheid (TF)'])
            ->add('PJ', IntegerType::class, ['attr' => ['min' => 0, 'max' => 10], 'label' => 'Ordelijkheid (PJ)'])
            ->add('TD', IntegerType::class, ['attr' => ['min' => 0, 'max' => 10], 'label' => 'Stabiliteit (TS)'])
            ->add(
                'MHW',
                ChoiceType::class,
                [
                    'attr' => [],
                    'label' => 'opleidings niveau',
                    'choices' => [
                        'Middelbaar onderwijs' => 0,
                        'Hoger onderwijs' => 1,
                        'Wetenschappelijk onderwijs' => 3,
                    ],
                ]
            )
            ->add('submit', SubmitType::class);
    }
}