<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:25 AM
 */

namespace Ford\Workflows;

/**
 * Class ActivityContext
 * @package Ford\Workflows
 */
class ActivityContext
{
    /**
     * @var string
     */
    private $trigger;

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

    /**
     * @return string
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @param string $trigger
     */
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;
    }
}