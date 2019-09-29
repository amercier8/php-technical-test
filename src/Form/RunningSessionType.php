<?php

namespace App\Form;

use App\Entity\RunningSession;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RunningSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('startTime')
            ->add('duration')
            ->add('distance')
            ->add('comment')
            ->add('averageSpeed')
            ->add('pace')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RunningSession::class,
        ]);
    }
}
