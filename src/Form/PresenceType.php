<?php

namespace App\Form;

use App\Entity\Presence;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('presence', ChoiceType::class, [
            'choices' => [
                'P' => 'present',
                'absent' => 'option_2',
                'excusé' => 'option_3',
                'blessé' => 'option_4',
                'renfort' => 'option_5',
            ],
            'expanded' => true,
        ])
    
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
