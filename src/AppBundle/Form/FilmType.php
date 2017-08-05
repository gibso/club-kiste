<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends ContentType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tmdbId', null, [
            'attr' => ['class' => 'form-control input-md'],
            'label_attr' => ['class' => 'col-md-4 control-label']
        ])->add('doorsopen', null, [
            'widget' => 'single_text',
            'format' => 'dd.MM.yyyy HH:mm',
            'attr' => [
                'class' => 'form-control input-md'
            ],
            'label_attr' => ['class' => 'col-md-4 control-label']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Film',
            'attr' => [
                'role' => 'form',
                'class' => 'form-horizontal'
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_film';
    }


}
