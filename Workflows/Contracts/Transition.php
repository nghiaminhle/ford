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
 * Interface Transition
 * @package Ford\Workflows\Contracts
 */
interface Transition
{
    /**
     * @param ActivityContext $context
     * @return bool
     */
    public function isSatisfy(ActivityContext $context): bool ;


    /**
     * @param ActivityContext $context
     * @return string
     */
    public function nextState(ActivityContext $context): string ;
}