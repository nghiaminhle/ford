<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 3:23 PM
 */

namespace Ford\Workflows;

use Ford\Workflows\Contracts\State;
use Ford\Workflows\Contracts\StateFactory as StateFactoryInterface;

/**
 * Class StateFactory
 * @package Ford\Workflows
 */
class StateFactory implements StateFactoryInterface
{
    /**
     * @var State[]
     */
    private $states = [];

    public function __construct(array $configurations)
    {
        foreach ($configurations as $configuration) {
            $state = $this->config($configuration);
            $this->states[$state->getName()] = $state;
        }
    }

    /**
     * @param string $state
     * @return State
     * @throws \Exception
     */
    public function factory(string $state)
    {
        if (array_key_exists($state, $this->states)) {
            return $this->states[$state];
        }
        throw new \Exception('State is not configured');
    }
    
    /**
     * @param array $configurations
     * @return State
     */
    private function config(array $configurations)
    {
        $state = new \Ford\Workflows\State($configurations['state']);
        $transitions = $configurations['transitions'];
        foreach ($transitions as $transition) {
            $t = new Transition($transition['state'], $transition['condition']);
            $state->addTransition($t);
        }
        if ($configurations['entry_activity'] !== null) {
            $state->setEntryActivity($configurations['entry_activity']);
        }
        if ($configurations['exit_activity'] !== null) {
            $state->setExitActivity($configurations['exit_activity']);
        }
        return $state;
    }
}