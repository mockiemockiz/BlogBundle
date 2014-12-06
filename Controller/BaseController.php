<?php
/**
 * Created by PhpStorm.
 * User: mockie
 * Date: 12/6/14
 * Time: 3:30 AM
 */

namespace Mockizart\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller {

    private  $entityService;

    private $params;

    protected $routesNames;

    public function setParams($paramKey)
    {
        $this->params = $this->container->getParameter($paramKey);
        $this->routesNames = $this->params['route_names'];

        return $this;
    }

    public function getParam($name)
    {
        return $this->params[$name];
    }

    public function getEntityService()
    {
        if (!$this->entityService) {
            $this->entityService = $this->get($this->getParam('service_entity_name'));
        }

        return $this->entityService;
    }

} 