<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PhpParser\Node\Expr\Yield_;


class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('isbn'),
            TextField::new('titre'),
            IntegerField::new('nombre_pages'),
            DateTimeField::new('date_parution'),
            IntegerField::new('note'),
            AssociationField::new('user')
                                    ->hideOnForm()
                                    ->hideOnIndex(),
            AssociationField::new('auteurs')
                                    ->autocomplete()
                                    ->hideOnIndex(),
                                   // ->hideOnF(),
            AssociationField::new('genres')
                                    ->autocomplete()
                                    ->hideOnIndex(),



        ];
    }


}
