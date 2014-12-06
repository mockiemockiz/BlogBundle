<?php
/**
 * Created by PhpStorm.
 * User: mockie
 * Date: 12/1/14
 * Time: 10:53 AM
 */
namespace Mockizart\BlogBundle\Service\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractModel implements AbstractModelInterface {

    /**
     * @var EntityManager
     */
    protected  $em;

    /**
     * @var EntityRepository
     */
    protected  $repository;

    /**
     * Entity object
     *
     * @var object
     */
    protected  $entity;

    /**
     * @var RequestStack
     */
    protected  $request;

    /**
     * @var array
     */
    protected  $params;

    abstract public function __construct($em, $params);

    abstract public function setEntity($id='');

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return object
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param string $key
     * @return RequestStack | string
     */
    public function getRequest($key='')
    {
        if (!$key) {
            return $this->request;
        }
        return $this->request->get($key);
    }

    public function findAllSelect($field, $keyField = 'id')
    {
        $data = $this->findAll();
        $result = [];

        foreach ($data as $key => $val) {
            $result[$val[$keyField]] = $val[$field];
        }

        return $result;
    }

    public function findAll()
    {
        $result = $this->getRepository()->createQueryBuilder('f')->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }

    /**
     * @param $id
     * @return null|object
     * @throws NotFoundHttpException
     */
    public function find($id)
    {
        $entity = $this->getRepository()->find($id);
        if (!$entity) {
            throw new NotFoundHttpException('Unable to find entity.');
        }
        return $entity;
    }

    /**
     * @param $form
     * @return bool
     */
    public function create($form)
    {
        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            $this->em->persist($this->getEntity());
            $this->em->flush();
            return $this->getEntity()->getId();
        }
        return false;
    }

    /**
     * @param $form
     * @return bool
     */
    public function save($form)
    {
        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            $this->em->flush();
            return true;
        }
        return false;
    }

    /**
     * @param $form
     * @return bool
     */
    public function delete($form)
    {
        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            $this->em->remove($this->getEntity());
            $this->em->flush();

            return true;
        }

        return false;
    }
}