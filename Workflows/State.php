<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:46 AM
 */

namespace Catalog\Workflows;


use Catalog\Workflows\Contracts\Activity;

use Catalog\Workflows\Contracts\State as StateInterface;
use Catalog\Workflows\Contracts\Transition;

/**
 * Class State
 * @package Catalog\Workflows
 */
class State implements StateInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Activity
     */
    protected $entryActivity;

    /**
     * @var Activity
     */
    protected $exitActivity;

    /**
     * @var Transition[]
     */
    protected $transitions = [];

    /**
     * State constructor.
     * @param string $name
     * @param Activity|null $entryActivity
     * @param Activity|null $exitActivity
     */
    public function __construct(string $name,
                                Activity $entryActivity = null,
                                Activity $exitActivity = null)
    {
        $this->name = $name;
        $this->entryActivity = $entryActivity;
        $this->exitActivity = $exitActivity;
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
    public function onEntry(ActivityContext $context)
    {
        if ($this->entryActivity === null) {
            return;
        }
        $this->entryActivity->execute($context);
    }

    /**
     * @param ActivityContext $context
     */
    public function onExit(ActivityContext $context)
    {
        if ($this->exitActivity === null) {
            return;
        }
        $this->exitActivity->execute($context);
    }

    /**
     * @param ActivityContext $context
     * @return string
     */
    public function getNextState(ActivityContext $context)
    {
        foreach ($this->transitions as $transition) {
            if ($transition->isSatisfy($context)) {
                return $transition->nextState($context);
            }
        }
        return null;
    }

    /**
     * @param Transition $transition
     */
    public function addTransition(Transition $transition)
    {
        $this->transitions[] = $transition;
    }

    /**
     * @param Activity $activity
     */
    public function setEntryActivity(Activity $activity)
    {
        $this->entryActivity = $activity;
    }

    /**
     * @param Activity $activity
     */
    public function setExitActivity(Activity $activity)
    {
        $this->exitActivity = $activity;
    }
}