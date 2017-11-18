<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:25 AM
 */

namespace Catalog\Workflows;


/**
 * Class ActivityContext
 * @package Catalog\Workflows
 */
class ActivityContext
{
    /**
     * @var array
     */
    private $params =[];

    /**
     * @param $key
     * @param $param
     */
    public function setParam($key, $param)
    {
        $this->params[$key] = $param;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getParam($key)
    {
        if(array_key_exists($key, $this->params)){
            return $this->params[$key];
        }
        return null;
    }
}