<?php
/**
 * Created by PhpStorm.
 * User: mockie
 * Date: 12/1/14
 * Time: 11:00 AM
 */

namespace Mockizart\BlogBundle\Service\Model;


class ModelFactory {

    public function createModelCategory($em, $params)
    {
        return new ModelCategory($em, $params);
    }
}
