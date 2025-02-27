<?php
namespace App\Form;

use App\Entity\Voeux;
use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $projets = $options['projets'];  // On passe les projets au formulaire

        // Ajouter des champs pour chaque projet
        for ($i = 1; $i <= 5; $i++) {
            $builder->add('projet_' . $i, ChoiceType::class, [
                'choices' => $projets,
                'label' => 'Choix ' . $i,
                'required' => false, // Les projets après le premier choix sont optionnels
            ]);
            $builder->add('priorite_' . $i, IntegerType::class, [
                'label' => 'Priorité ' . $i,
                'attr' => ['min' => 1, 'max' => 5],
                'required' => false, // Priorité n'est pas requise si aucun projet n'est choisi
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
