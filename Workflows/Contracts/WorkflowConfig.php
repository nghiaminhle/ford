<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/21/17
 * Time: 9:17 PM
 */

namespace Ford\Workflows\Contracts;


/**
 * Interface WorkflowConfig
 * @package Ford\Workflows\Contracts
 */
interface WorkflowConfig
{
    /**
     * @param array $configurations
     */
    public function load(array $configurations);

    /**
     * @param string $fromState
     * @param string $trigger
     * @return Transition[]
     */
    public function getTransitions(string $fromState, string $trigger);

    /**
     * @param string $state
     * @return State
     */
    public function stateFactory(string $state);
}