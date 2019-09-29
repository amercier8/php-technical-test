<?php

namespace App\Form;

use App\Entity\RunningSession;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RunningSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class, ['label' => 'Type de sortie'])
            ->add('startTime', DateTimeType::class,
                [
                    'label' => 'Date et heure de début',
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                ])
            ->add('duration', IntegerType::class,
                [
                    'label' => 'Durée (en minutes)',
                ])
            ->add('distance', NumberType::class,
                [
                    'label' => 'Distance (en kilomètres)',
                    'scale' => 2,
                ])
            ->add('comment', TextType::class,
                [
                    'label' => 'Commentaire',
                    'required' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RunningSession::class,
        ]);
    }
}
