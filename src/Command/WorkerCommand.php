<?php

namespace App\Command;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsCommand(name: 'app:worker')]
class WorkerCommand extends Command
{
    protected static $defaultName = 'app:worker';

    private SqsClient $sqsClient;
    private ContainerBagInterface $params;

    public function __construct(SqsClient $sqsClient, ContainerBagInterface $params, string $name = null)
    {
        parent::__construct();
        $this->sqsClient = $sqsClient;
        $this->params = $params;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueUrl = $this->params->get('sqsUrl');
        try {
            $result = $this->sqsClient->receiveMessage(array(
                'AttributeNames' => ['SentTimestamp'],
                'MaxNumberOfMessages' => 1,
                'MessageAttributeNames' => ['All'],
                'QueueUrl' => $queueUrl,
                'WaitTimeSeconds' => 0,
            ));
            if (!empty($result->get('Messages'))) {
                $output->writeln('Worker has received message: ');
                $output->writeln($result->get('Messages')[0]['Body']);
                $result = $this->sqsClient->deleteMessage([
                    'QueueUrl' => $queueUrl,
                    'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle']
                ]);
            } else {
                $output->writeln("No messages in queue.");
            }
        } catch (AwsException $e) {
            error_log($e->getMessage());
        }

        return Command::SUCCESS;
    }
}
