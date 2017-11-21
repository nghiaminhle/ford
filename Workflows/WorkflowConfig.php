<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/21/17
 * Time: 10:24 PM
 */

namespace Ford\Workflows;

use Ford\Workflows\Contracts\State;
use Ford\Workflows\Contracts\Transition;
use Ford\Workflows\Contracts\WorkflowConfig as WorkflowConfigInterface;

/**
 * Class WorkflowConfig
 * @package Ford\Workflows
 */
class WorkflowConfig implements WorkflowConfigInterface
{
    /**
     * @var State[]
     */
    protected $states = [];

    /**
     * @var Transition[]
     */
    protected $transitions = [];

    /**
     * @param array $configurations
     */
    public function load(array $configurations)
    {
        foreach ($configurations as $configuration) {
            $this->configState($configuration);
            $this->configTransition($configuration['state'], $configuration['transitions']);
        }
    }

    /**
     * @param array $configuration
     * @throws ConfigException
     */
    private function configState(array $configuration)
    {
        $state = new \Ford\Workflows\State($configuration['state']);
        foreach ($configuration['activities'] as $activity) {
            $state->addActivity($activity);
        }
        $this->states[$state->getName()] = $state;
    }

    /**
     * @param string $fromState
     * @param array $transitionConfigs
     */
    private function configTransition(string $fromState, array $transitionConfigs)
    {
        foreach ($transitionConfigs as $transition){
            $tr = new \Ford\Workflows\Transition(
                $fromState,
                $transition['to_state'],
                $transition['trigger'],
                $transition['condition']);
            $key = $this->getKey($fromState, $tr->triggeredBy());
            if(!array_key_exists($key, $this->transitions)){
                $this->transitions[$key] = [];
            }
            $this->transitions[$key][] = $tr;
        }
    }

    /**
     * @param string $fromState
     * @param string $trigger
     * @return Transition[]
     * @throws ConfigException
     */
    public function getTransitions(string $fromState, string $trigger)
    {
        $key = $this->getKey($fromState, $trigger);
        if(array_key_exists($key, $this->transitions)){
            return $this->transitions[$key];
        }
        return [];
    }

    /**
     * @param $fromState
     * @param $trigger
     * @return string
     */
    private function getKey($fromState, $trigger)
    {
        return $fromState.'_'.$trigger;
    }

    /**
     * @param string $state
     * @return State
     * @throws ConfigException
     */
    public function stateFactory(string $state)
    {
        if(array_key_exists($state, $this->states)){
            return $this->states[$state];
        }
        throw new ConfigException('State is not configured');
    }
}