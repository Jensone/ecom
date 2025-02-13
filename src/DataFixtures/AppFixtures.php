<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // ----- Admin -----
        $admin = new User();
        $admin
            ->setEmail('admin@admin.fr')
            ->setPassword('$2y$13$ipUSLg.MKR9hdbV7lnvocOlBRvqawSIqspDQo8JIDQyw1H9i6veQi')
            ->setRoles(['ROLE_ADMIN'])
        ;
        $manager->persist($admin);

        $user = new User();
        $user
            ->setEmail('user@admin.fr')
            ->setPassword('$2y$13$ipUSLg.MKR9hdbV7lnvocOlBRvqawSIqspDQo8JIDQyw1H9i6veQi')
            ->setRoles(['ROLE_USER'])
        ;
        $manager->persist($user);
        
        // ----- Liste des catégories -----
        $categoryList = [
            'Helmets',
            'Shields',
            'Headgear',
            'Gloves',
            'Boots',
            'Accessories',
            'Belts',
            'Bracelets',
            'Rings',
            'Necklaces',
            'Earrings',
            'Rings',
            'Amulets',
            'Charms',
            'Jewelry',
        ];
        $categoryArray = [];
        foreach ($categoryList as $item) {
            $category = new Category(); // Nouvel objet Category
            $category
                ->setRef(uniqid('CAT_'))
                ->setName($item)
                ->setImage($faker->imageUrl(100, 100, 'gaming'))
                ; // Ajout des attributs à l'objet Category
            
            array_push($categoryArray, $category); // Ajout de l'objet Category à la liste
            $manager->persist($category); // Enregistrement
        }

        // ----- 100 Products -----
        $nameList = [
            'Sword of ',
            'Shield from ',
            'Hammer of ',
            'Sniffer of '
        ];
        for ($i=0; $i < 100; $i++) { 
            $product = new Product();
            $product
                ->setRef(uniqid('ITEM_'))
                ->setName($faker->randomElement($nameList).$faker->firstname)
                ->setPrice($faker->randomFloat(2, 0, 1000))
                ->setDescription($faker->paragraph(4))
                ->setImage($faker->imageUrl(100, 100, 'gaming'))
                ->setCategory($faker->randomElement($categoryArray))
                ; // Ajout des attributs à l'objet Product
            $manager->persist($product);
        }

        $manager->flush();
    }
}
