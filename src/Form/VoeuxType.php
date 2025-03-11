<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class VoeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $projets = $options['projets'];

        for ($i = 1; $i <= 5; $i++) {
            $builder->add('projet_' . $i, ChoiceType::class, [
                'choices' => $projets,
                'label' => 'Choix ' . $i,
                'required' => true,
                'placeholder' => 'Sélectionnez un projet',  
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez sélectionner un projet.']),
                ],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'projets' => [],
        ]);
    }

    public function validate($data, ExecutionContextInterface $context)
    {
        $selectedProjects = [];
        for ($i = 1; $i <= 5; $i++) {
            $projetField = "projet_" . $i;
            if (!empty($data[$projetField])) {
                if (in_array($data[$projetField], $selectedProjects)) {
                    $context->buildViolation('Vous ne pouvez pas sélectionner le même projet plusieurs fois.')
                        ->atPath($projetField)
                        ->addViolation();
                }
                $selectedProjects[] = $data[$projetField];
            }
        }

        if (count($selectedProjects) !== 5) {
            $context->buildViolation('Vous devez sélectionner exactement 5 projets.')
                ->addViolation();
        }
    }
}
