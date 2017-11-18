<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 3:46 PM
 */

namespace Ford\Workflows\Examples;


class StateConstant
{
    const INIT = 'init';
    const FIRST_APPROVE = 'first_approve';
    const SECOND_APPROVE = 'second_approve';
    const APPROVE = 'approve';
    const REJECT = 'reject';
}