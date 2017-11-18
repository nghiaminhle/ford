<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 12:37 PM
 */

namespace Ford\Workflows\Contracts;

/**
 * Interface StateFactory
 * @package Ford\Workflows\Contracts
 */
interface StateFactory
{
    /**
     * @param string $state
     * @return State
     */
    public function factory(string $state);
}