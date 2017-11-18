<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:13 AM
 */

namespace Ford\Workflows;

use Ford\Workflows\Contracts\Workflow as WorkflowInterface;

/**
 * Class WorkFlow
 * @package Ford\Workflows
 */
class WorkFlow implements WorkflowInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $currentState;

    /**
     * @var StateFactory
     */
    private $stateFactory;

    public function __construct(StateFactory $stateFactory)
    {
        $this->stateFactory = $stateFactory;
    }

    /**
     * @param ActivityContext $context
     */
    public function run(ActivityContext $context)
    {
        $state = $this->stateFactory->factory($this->currentState);
        $state->onExit($context);
        $nextState = $state->getNextState($context);
        if ($nextState !== null) {
            $this->currentState = $nextState;
            $nextStateObj = $this->stateFactory->factory($nextState);
            $nextStateObj->onEntry($context);
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCurrentState()
    {
        return $this->currentState;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $currentState
     */
    public function setCurrentState($currentState)
    {
        $this->currentState = $currentState;
    }
}