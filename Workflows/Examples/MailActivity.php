<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 3:58 PM
 */

namespace Catalog\Workflows\Examples;

use Catalog\Workflows\ActivityContext;
use Catalog\Workflows\Contracts\Activity;

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