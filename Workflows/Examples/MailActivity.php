<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 3:58 PM
 */

namespace Ford\Workflows\Examples;

use Ford\Workflows\ActivityContext;
use Ford\Workflows\Contracts\Activity;

class MailActivity implements Activity
{
    /**
     * @param ActivityContext $context
     */
    public function execute(ActivityContext $context)
    {
        echo "\n".'Send mail: '.$context->getParam('msg')."\n";
    }
}