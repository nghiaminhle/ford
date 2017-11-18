<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/18/17
 * Time: 10:29 PM
 */

namespace Catalog\Workflows\Contracts;


use Catalog\Workflows\WorkFlow;

/**
 * Interface WorkflowStore
 * @package Catalog\Workflows\Contracts
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