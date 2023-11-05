<?php

namespace App\Form;

use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            // ->add('id')
            ->add('numeroEquipe', ChoiceType::class,
            [ 'choices' => range(1, 10),
            ])
            ->add('categorieGenre', ChoiceType::class, [
                'choices' => [
                    'F' => 'F',
                    'M' => 'M',
                ],
                'placeholder' => 'Genre',
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
