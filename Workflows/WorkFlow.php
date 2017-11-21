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
     * @var WorkflowConfig
     */
    private $wfConfig;

    /**
     * WorkFlow constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param ActivityContext $context
     * @throws ConfigException
     */
    public function run(ActivityContext $context)
    {
        $transitions = $this->wfConfig->getTransitions($this->currentState, $context->getTrigger());
        foreach ($transitions as $transition) {
            if ($transition->isSatisfy($context)) {
                $this->currentState = $transition->nextState($context);
                $nextState = $this->wfConfig->stateFactory($this->currentState);
                $nextState->execute($context);
                return;
            }
        }
    }

    /**
     * @param WorkflowConfig $workflowConfig
     */
    public function setWorkflowConfiguration(WorkflowConfig $workflowConfig)
    {
        $this->wfConfig = $workflowConfig;
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