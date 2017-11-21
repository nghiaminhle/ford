<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 4:38 PM
 */

namespace Ford\Workflows;


use Ford\Workflows\Contracts\Transition as TransitionInterface;

/**
 * Class Transition
 * @package Ford\Workflows
 */
class Transition implements TransitionInterface
{
    /**
     * @var string
     */
    protected $trigger;

    /**
     * @var string
     */
    protected $_fromState;

    /**
     * @var string
     */
    protected $nextState;

    /**
     * @var callable
     */
    protected $isSatisfyFunc;

    /**
     * Transition constructor.
     * @param string $fromState
     * @param string $toState
     * @param string $trigger
     * @param callable|null $isSatisfyFunc
     */
    public function __construct(string $fromState,
                                string $toState,
                                string $trigger,
                                callable $isSatisfyFunc = null)
    {
        $this->_fromState = $fromState;
        $this->nextState = $toState;
        $this->trigger = $trigger;
        $this->isSatisfyFunc = $isSatisfyFunc;
    }

    /**
     * @param ActivityContext $context
     * @return bool
     */
    public function isSatisfy(ActivityContext $context): bool
    {
        if ($this->isSatisfyFunc !== null) {
            return call_user_func($this->isSatisfyFunc, $context);
        }
        return true;
    }

    /**
     * @return string
     */
    public function fromState(): string
    {
        return $this->fromState();
    }

    /**
     * @return string
     */
    public function nextState(): string
    {
        return $this->nextState;
    }

    /**
     * @return string
     */
    public function triggeredBy():string
    {
        return $this->trigger;
    }
}