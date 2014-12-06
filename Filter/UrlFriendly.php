<?php
/**
 * Created by PhpStorm.
 * User: mockie
 * Date: 11/13/14
 * Time: 1:24 AM
 */

namespace Mockizart\BlogBundle\Filter;


class UrlFriendly {

    public function filter($str)
    {
        $str = strtolower($str);
        $str = preg_replace('/[^a-z0-9]+/', '-', $str);
        $str = trim($str, '-');

        return $str;
    }

} 