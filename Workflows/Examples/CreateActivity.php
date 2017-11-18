<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/18/17
 * Time: 3:41 PM
 */

namespace Ford\Workflows\Examples;


use Ford\Workflows\ActivityContext;
use Ford\Workflows\Contracts\Activity;

/**
 * Class CreateActivity
 * @package Ford\Workflows\Examples
 */
class CreateActivity implements Activity
{
    /**
     * @param ActivityContext $context
     */
    public function execute(ActivityContext $context)
    {
        echo "\n".'Propose the request to the first manager to approve'."\n";
    }

}