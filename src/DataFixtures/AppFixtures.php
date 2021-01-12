<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin  ->setUsername('iss')
                ->setPassword('2612');
        
        $encoded = $this->encoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($encoded);

        $manager->persist($admin);
        
        for($i = 0; $i < 12 ; $i++ )
        {
            $project = new Project();

            $project->setTitle('MonProj Title')
                    ->setIntroduction('Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum')
                    ->setDescription('Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dignissimos tenetur dolorem 
                    reprehenderit cupiditate! Saepe omnis quis placeat praesentium quaerat neque aliquam nesciunt ipsa 
                    aspernatur similique voluptatem ab excepturi officia voluptatibus, sit fugit quidem quos facere culpa necessitatibus accusamus. 
                    Corporis obcaecati voluptas distinctio veniam reprehenderit, ab facere perspiciatis voluptate ullam harum.')
                    ->setImage('https://cdnfr1.img.sputniknews.com/img/104379/62/1043796254_0:98:1920:1136_1000x541_80_0_0_1d42645205d1d5926e28f3bfccc44639.jpg')
                    ->setGithub('https://google.fr');

            $manager->persist($project);

        }

        $manager->flush();
    }

}