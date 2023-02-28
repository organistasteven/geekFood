<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', TextType::class, [
            'label' => 'Nom de famille',
        ])
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
        ])
        ->add('mail', TextType::class, [
            'label' => 'Adresse e-mail',
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => 'Numéro de téléphone',
        ])
        ->add('groupSize', TextType::class, [
            'label' => 'Taille du groupe',
        ])
        ->add('date')
        ->add('complementaryIntel', TextAreaType::class, [
            'label' => 'Informations complémentaires',
        ])
        ->remove('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
