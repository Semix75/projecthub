<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $projets = $options['projets'];  // Récupère la liste des projets

        // Ajouter des champs pour chaque projet (le premier est le plus préféré)
        for ($i = 1; $i <= 5; $i++) {
            $builder->add('projet_' . $i, ChoiceType::class, [
                'choices' => $projets,
                'label' => 'Choix ' . $i,
                'required' => false, // Permet de ne pas forcer le choix des 5
            ]);
        }
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,  // On n'utilise pas une entité directement
            'projets' => [], // On passe les projets depuis le contrôleur
        ]);
    }
}
