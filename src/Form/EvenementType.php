<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', ChoiceType::class, [
                'choices' => [
                    'match' => 'match',
                    'entrainement' => 'entrainement',
                ]
            ])
            ->add('start')
            ->add('end')
            // ->add('background_color')
            // ->add('border_color')
            // ->add('text_color')
            ->add('equipes');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
