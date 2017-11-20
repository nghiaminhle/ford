<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/18/17
 * Time: 10:29 PM
 */

namespace Ford\Workflows\Contracts;


use Ford\Workflows\WorkFlow;

/**
 * Interface WorkflowStore
 * @package Ford\Workflows\Contracts
 */
interface WorkflowStore
{
    /**
     * @param $id
     * @return WorkFlow
     */
    public function find($id);

    /**
     * @param WorkFlow $workFlow
     */
    public function save(WorkFlow $workFlow);
}