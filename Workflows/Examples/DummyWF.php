<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:46 AM
 */

namespace Catalog\Workflows\Examples;


use Catalog\Workflows\ActivityContext;
use Catalog\Workflows\StateFactory;
use Catalog\Workflows\WorkFlow;

/**
 * Class DummyWF
 * @package Catalog\Workflows\Examples
 */
class DummyWF
{
    /**
     * @var WorkFlow
     */
    private $workflowInstance;

    /**
     * DummyWF constructor.
     */
    public function __construct()
    {
        $stateFactory = new StateFactory($this->getConfigurations());

        $this->workflowInstance = new WorkFlow($stateFactory);
        $this->workflowInstance->setId('abc');
        $this->workflowInstance->setCurrentState(StateConstant::INIT);
    }

    /**
     *
     */
    public function test()
    {
        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";
        $context = new ActivityContext();
        $this->workflowInstance->run($context);

        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";

        $context = new ActivityContext();
        $context->setParam('isApproved', true);

        $this->workflowInstance->run($context);
        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";

        $context = new ActivityContext();
        $context->setParam('isApproved', false);
        $context->setParam('msg', 'request is rejected');

        $this->workflowInstance->run($context);
        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";
    }

    private function getConfigurations()
    {
        $approveCondition = function (ActivityContext $context) {
            return $context->getParam('isApproved') === true;
        };

        $rejectCondition = function (ActivityContext $context) {
            return $context->getParam('isApproved') === false;
        };

        $configurations = [
            [
                'state' => StateConstant::INIT,
                'transitions' => [
                    [
                        'state' => StateConstant::FIRST_APPROVE,
                        'condition' => function (ActivityContext $context) {
                            return true;
                        }
                    ]
                ],
                'entry_activity' => null,
                'exit_activity' => new CreateActivity()
            ],
            [
                'state' => StateConstant::FIRST_APPROVE,
                'transitions' => [
                    [
                        'state' => StateConstant::SECOND_APPROVE,
                        'condition' => $approveCondition
                    ],
                    [
                        'state' => StateConstant::REJECT,
                        'condition' => $rejectCondition
                    ]
                ],
                'entry_activity' => null,
                'exit_activity' => null
            ],
            [
                'state' => StateConstant::SECOND_APPROVE,
                'transitions' => [
                    [
                        'state' => StateConstant::APPROVE,
                        'condition' => $approveCondition
                    ],
                    [
                        'state' => StateConstant::REJECT,
                        'condition' => $rejectCondition
                    ]
                ],
                'entry_activity' => null,
                'exit_activity' => new CompleteActivity()
            ],
            [
                'state' => StateConstant::REJECT,
                'transitions' => [],
                'entry_activity' => new MailActivity(),
                'exit_activity' => null
            ],
            [
                'state' => StateConstant::APPROVE,
                'transitions' => [],
                'entry_activity' => new MailActivity(),
                'exit_activity' => null
            ]
        ];

        return $configurations;
    }
}