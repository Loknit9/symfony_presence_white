<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add(
                'equipe',
                EntityType::class,
                [
                    'class' => Equipe::class,
                    'choice_label' => 'nom',
                    'attr' => ['class' => 'd-none'],
                    'label' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
