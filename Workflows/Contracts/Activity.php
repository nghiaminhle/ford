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
 * Interface Activity
 * @package Catalog\Workflows\Contracts
 */
interface Activity
{
    /**
     * @param ActivityContext $context
     */
    public function execute(ActivityContext $context);
}