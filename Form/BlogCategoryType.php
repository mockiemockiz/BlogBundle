<?php

namespace Mockizart\BlogBundle\Form;

use Mockizart\BlogBundle\Service\Model\ModelCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogCategoryType extends AbstractType
{

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var ModelCategory
     */
    private $entityFactory;

    /**
     * @var Router
     */

    private $route;
    /**
     * @var array
     */

    private $params;

    public function __construct($params)
    {
        $this->formFactory = $params['form_factory'];
        $this->entityFactory = $params['entity_factory'];
        $this->route = $params['router'];
        $this->params = $params['params'];
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('content', null, ['required' => false])
            ->add(
                'parentId',
                'choice',
                [
                    'required' => false,
                    'choices' => array_merge([0 => 'No parent'], $this->entityFactory->findAllSelect('name')),
                ]
            )
            ->add('slug', null, ['required' => false])
            ->add('type', 'choice', ['choices' => $this->params['type']])
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
        return $this->params['form_alias'];
    }

    public function createForm($entity)
    {
        $form =  $this->formFactory->create(
            $this->getName(), $entity, array(
                'action' => $this->route->generate('category_create'),
                'method' => 'POST',
            )
        );
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    public function editForm($entity)
    {
        $form = $this->formFactory->create( $this, $entity, array(
            'action' => $this->route->generate('category_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }
    
    public function deleteForm($id)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->route->generate('category_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

}
