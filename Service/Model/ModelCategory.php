<?php
/**
 * Created by PhpStorm.
 * User: mockie
 * Date: 12/1/14
 * Time: 11:45 AM
 */

namespace Mockizart\BlogBundle\Service\Model;

use Doctrine\ORM\EntityRepository;
use Mockizart\BlogBundle\Entity\BlogCategory;

class ModelCategory extends AbstractModel {

    public function __construct($em, $params)
    {
        $this->params = $params['params'];
        $this->em = $em['entity_manager'];
    }

    /**
     * Set slug, if slug input blank use name input instead.
     */
    private function setSlug()
    {
        $postData = $this->getRequest($this->params['form_alias']);
        $slug = ($postData['slug']) ? $postData['slug'] : $postData['name'];
        $this->request->request->set($this->params['form_alias'], array_merge($postData,['slug' => $slug]));
    }

    /**
     * Set Entity
     *
     * @param string $id
     * @return $this
     */
    public function setEntity($id='')
    {
        $this->entity = (!$id) ? new BlogCategory() : $this->find($id);

        return $this;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        if (!$this->repository) {
            $this->repository = $this->em->getRepository($this->params['entity_alias']);
        }
        return parent::getRepository();
    }

    /**
     * @param $form
     * @return bool
     */
    public function create($form)
    {
        $this->setSlug();
        $this->getEntity()->setCreated(date_create("now"));
        $this->getEntity()->setTotalPost(0);
        return parent::create($form);
    }

    /**
     * @param $form
     * @return bool
     */
    public function save($form)
    {
        $this->setSlug();
        return parent::save($form);
    }

} 