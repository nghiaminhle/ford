<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:58 AM
 */

namespace Ford\Workflows\Contracts;


use Ford\Workflows\ActivityContext;

/**
 * Interface Workflow
 * @package Ford\Workflows\Contracts
 */
interface Workflow
{
    /**
     * @param ActivityContext $context
     */
    public function run(ActivityContext $context);
}