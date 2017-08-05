<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartyType extends ContentType
{
    protected function addFieldsToForm()
    {
        return ['admission', 'boxoffice', 'preselling'];
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('doorsopen', null, [
            'widget' => 'single_text',
            'format' => 'dd.MM.yyyy HH:mm',
            'attr' => ['class' => 'form-control input-md'],
            'label_attr' => ['class' => 'col-md-4 control-label']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Party',
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
        return 'appbundle_party';
    }
}
