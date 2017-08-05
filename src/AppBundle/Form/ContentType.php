<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class ContentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = ['title', 'content', 'imageFile'];
        $fields = array_merge($fields, $this->addFieldsToForm());

        foreach ($fields as $field) {
            $builder->add($field, null, [
                'attr' => ['class' => 'form-control input-md'],
                'label_attr' => ['class' => 'col-md-4 control-label']
            ]);
        }
    }

    /***
     * @return array
     */
    protected function addFieldsToForm()
    {
        return [];
    }
}