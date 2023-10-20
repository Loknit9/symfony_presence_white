<?php

namespace App\Form;

use App\Entity\Personne;
use App\Entity\Presence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'etat',
                ChoiceType::class,
                [
                    'choices' => [
                        'present' => 'P',
                        'absent' => 'A',
                        'excuse' => 'E',
                        'blesse' => 'B',
                        'renfort' => 'R',
                    ],
                    'expanded' => true,
                    'choice_label' => false,
                    'label' => false,
                    'attr' => ['class' => 'espace_radio'], 
                ]
            )
            ->add(
                'joueur',
                EntityType::class,
                [
                    'class' => Personne::class,
                    'choice_label' => 'nom',
                    'attr' => ['class' => 'd-none']
                ]

            )
            // ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
