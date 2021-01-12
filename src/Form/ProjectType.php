<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectType extends AbstractType
{
    public function getOption($label, $placeholder)
    {
        return ;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                    'label' => 'Titre du projet',
                    'attr' => [
                        'placeholder' => 'Mon titre'
                    ]
                ])
            ->add('introduction', TextType::class, [
                    'label' => 'Introduction du projet',
                    'attr' => [
                        'placeholder' => 'Mon introduction'
                    ]
                ])
            ->add('description', TextareaType::class, [
                    'label' => 'Description du projet',
                    'attr' => [
                        'placeholder' => 'Ma description'
                    ]
                ])
            ->add('image', UrlType::class, [
                    'label' => 'Image du projet',
                    'attr' => [
                        'placeholder' => 'Mon image'
                    ]
            ])
            ->add('github', UrlType::class, [
                    'label' => 'Repository du projet',
                    'attr' => [
                        'placeholder' => 'Mon repository'
                    ]
                ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-info'
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
