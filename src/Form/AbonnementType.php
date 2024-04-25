<?php

namespace App\Form;

use App\Entity\Abonnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('duree_abonnement', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label_attr' => ['class' => 'form-label'],
        ])
        ->add('duree_abonnement', ChoiceType::class, [
            'choices' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
            ],
            'attr' => ['class' => 'form-select'],
            'label' => 'Region salle',
        ])
        ->add('prix_abonnement', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label_attr' => ['class' => 'form-label'],
        ])
        ->add('date_deb_abonnement')
        ->add('date_fin_abonnement')
        ->add('salle');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
