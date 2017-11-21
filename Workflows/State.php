<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:46 AM
 */

namespace Ford\Workflows;


use Ford\Workflows\Contracts\Activity;

use Ford\Workflows\Contracts\State as StateInterface;
use Ford\Workflows\Contracts\Transition;

/**
 * Class State
 * @package Ford\Workflows
 */
class State implements StateInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Activity[]
     */
    protected $activities = [];

    /**
     * State constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param ActivityContext $context
     */
    public function execute(ActivityContext $context)
    {
        foreach ($this->activities as $activity){
            $activity->execute($context);
        }
    }

    /**
     * @param Activity $activity
     */
    public function addActivity(Activity $activity)
    {
        $this->activities[] = $activity;
    }
}