<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nghia.le
 * Date: 11/18/17
 * Time: 11:46 AM
 */

namespace Ford\Workflows\Examples;


use Ford\Workflows\ActivityContext;
use Ford\Workflows\WorkFlow;
use Ford\Workflows\WorkflowConfig;

/**
 * Class DummyWF
 * @package Ford\Workflows\Examples
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
        $this->workflowInstance = new WorkFlow();
        $wfConfig = new WorkflowConfig();
        $wfConfig->load($this->getConfigurations());

        $this->workflowInstance->setId('abc');
        $this->workflowInstance->setCurrentState(StateConstant::INIT);
        $this->workflowInstance->setWorkflowConfiguration($wfConfig);
    }

    /**
     *
     */
    public function test()
    {
        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";
        $context = new ActivityContext();
        $context->setTrigger('approve');
        $context->setParam('msg', 'request is approved by the first manager');
        $this->workflowInstance->run($context);

        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";

        $context = new ActivityContext();
        $context->setTrigger('reject');
        $context->setParam('msg', 'request is rejected by the second manager');
        $this->workflowInstance->run($context);

        echo "\n" . 'Current State: ' . $this->workflowInstance->getCurrentState() . "\n";

        $context = new ActivityContext();
        $context->setTrigger('re-submit');
        $context->setParam('msg', 'request is approved by the second manager');
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
                        'to_state' => StateConstant::FIRST_APPROVE,
                        'condition' => function (ActivityContext $context) {
                            return true;
                        },
                        'trigger'=> 'approve'
                    ]
                ],
                'activities'=>[]
            ],
            [
                'state' => StateConstant::FIRST_APPROVE,
                'transitions' => [
                    [
                        'to_state' => StateConstant::SECOND_APPROVE,
                        'condition' => function (ActivityContext $context) {
                            return true;
                        },
                        'trigger'=> 'approve'
                    ],
                    [
                        'to_state' => StateConstant::REJECT,
                        'condition' => function (ActivityContext $context) {
                            return true;
                        },
                        'trigger'=> 'reject'
                    ]
                ],
                'activities'=>[new MailActivity()]
            ],
            [
                'state' => StateConstant::SECOND_APPROVE,
                'transitions' => [],
                'activities'=>[new MailActivity(),new CompleteActivity()]
            ],
            [
                'state' => StateConstant::REJECT,
                'transitions' => [
                    [
                        'to_state' => StateConstant::SECOND_APPROVE,
                        'condition' => function (ActivityContext $context) {
                            return true;
                        },
                        'trigger'=> 're-submit'
                    ]
                ],
                'activities'=>[new MailActivity()]
            ]
        ];

        return $configurations;
    }
}