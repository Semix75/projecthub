<?php

namespace App\Controller\Admin;

use App\Entity\Attribution;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AttributionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribution::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setLabel('User'),
            AssociationField::new('projet')->setLabel('Projet'),

        ];
    }

public function configureActions(Actions $actions): Actions
{
    $attribuerAction = Action::new('attribuer', "Lancer l'attribution")
        ->linkToRoute('attribuer_voeux')
        ->createAsGlobalAction();

    return $actions
        ->add(Crud::PAGE_INDEX, $attribuerAction);
}

}
