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
    protected $nextState;

    /**
     * @var StateFactory
     */
    protected $stateFactory;

    /**
     * @var callable
     */
    protected $isSatisfyFunc;

    /**
     * Transition constructor.
     * @param string $nextState
     * @param callable $isSatisfyFunc
     */
    public function __construct(string $nextState, callable $isSatisfyFunc = null)
    {
        $this->nextState = $nextState;
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
     * @param ActivityContext $context
     * @return string
     */
    public function nextState(ActivityContext $context): string
    {
        return $this->nextState;
    }
}