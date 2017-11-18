<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:58 AM
 */

namespace Catalog\Workflows\Contracts;


use Catalog\Workflows\ActivityContext;

/**
 * Interface Workflow
 * @package Catalog\Workflows\Contracts
 */
interface Workflow
{
    /**
     * @param ActivityContext $context
     */
    public function run(ActivityContext $context);
}