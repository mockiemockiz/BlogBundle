<?php

namespace Mockizart\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created')
            ->add('name')
            ->add('content')
            ->add('parentId')
            ->add('slug')
            ->add('totalPost')
            ->add('type')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mockizart\BlogBundle\Entity\BlogCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mockizart_blogbundle_blogcategory';
    }
}
