<?php

namespace App\DataFixtures;

use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use App\Entity\Brand;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands =[];
        for ($i=0; $i <5 ; $i++) { 
            $brand = new Brand();
            $brand->setName('Renault' .$i);
            $brand->setCountryOfManufacture('France' .$i);
            $brand->setManufactureName('Louis Renault' .$i);
            $brand->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3yIgMrSYFw2X31TgnFLUwAgFcmNv86R0z6w&s' .$i);
            $manager->persist($brand);
            $brands[] = $brand;
        }
        
        for ($i=0; $i <20 ; $i++) { 
            $model = new Model();
            $model->setName (Name: 'Model' . $i);
            $model->setSerialNumber('SN-' . str_pad($i, 10, '0', STR_PAD_LEFT));
            $model->setDateOfManufacture(new DateTime("2025-07-08 +{$i}days"));
            $model->setBrand($brands[$i % 5]);
            $manager->persist($model);
        }

        $manager->flush();
    }
}