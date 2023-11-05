<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Personne;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('contact1', EmailType::class)
            ->add('contact2', EmailType::class)
            ->add('dateNaissance', BirthdayType::class, [
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                'years' => range(date('Y'), 1980)
            ])
            ->add('equipesCoaches', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' =>'nom',
                'multiple' => true,
                ])
            ->add('equipesJoueur', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' =>'nom',
                'multiple' => true,
            ]);
            }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
