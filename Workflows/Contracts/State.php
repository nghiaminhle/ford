<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:14 AM
 */

namespace Ford\Workflows\Contracts;

use Ford\Workflows\ActivityContext;

/**
 * Interface State
 * @package Ford\Workflows\Contracts
 */
interface State
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param ActivityContext $context
     */
    public function onEntry(ActivityContext $context);

    /**
     * @param ActivityContext $context
     */
    public function onExit(ActivityContext $context);

    /**
     * @param ActivityContext $context
     * @return string
     */
    public function getNextState(ActivityContext $context);

    /**
     * @param Transition $transition
     */
    public function addTransition(Transition $transition);

    /**
     * @param Activity $activity
     */
    public function setEntryActivity(Activity $activity);

    /**
     * @param Activity $activity
     */
    public function setExitActivity(Activity $activity);
}