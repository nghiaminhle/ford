<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 4:31 PM
 */

namespace Catalog\Workflows\Examples;

use Catalog\Workflows\ActivityContext;
use Catalog\Workflows\Contracts\Activity;

class CompleteActivity implements Activity
{
    /**
     * @param ActivityContext $context
     */
    public function execute(ActivityContext $context)
    {
        echo "\n".'The process is completed'."\n";
    }
}