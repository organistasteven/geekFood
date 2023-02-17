<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Membre' => 'ROLE_USER',
                    'Gestionnaire' => 'ROLE_MANAGER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            // écouteur d'événement pour gérer le champ mot passe
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {

                // on récupère via l'event, le user et le form
                $user = $event->getData();
                $form = $event->getForm();

                if ($user->getId() === null) {
                    // si nouvel utilisateur, il n'a pas d'id !
                    $form->add('password');
                } else {
                    // si user existant
                    $form->add('password', null, [
                        // @see https://symfony.com/doc/5.4/reference/forms/types/email.html#mapped
                        'mapped' => false,
                        'attr' => [
                            'placeholder' => 'Laissez vide si inchangé...',
                        ]
                    ]);
                }
            });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
