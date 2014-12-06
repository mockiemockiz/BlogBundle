<?php
/**
 * Created by PhpStorm.
 * User: mockie
 * Date: 12/3/14
 * Time: 6:22 AM
 */
namespace Mockizart\BlogBundle\Service\Model;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

interface AbstractModelInterface {

    public function __construct($em, $params);

    /**
     * @return EntityRepository
     */
    public function getRepository();

    /**
     * @return object
     */
    public function getEntity();

    /**
     * @param string $key
     * @return RequestStack | string
     */
    public function getRequest($key='');

    /**
     * @param $id
     * @return null|object
     * @throws NotFoundHttpException
     */
    public function find($id);

    /**
     * @param $form
     * @return bool
     */
    public function create($form);

    /**
     * @param $form
     * @return bool
     */
    public function save($form);

    /**
     * @param $form
     * @return bool
     */
    public function delete($form);

}
