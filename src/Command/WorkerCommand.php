<?php

namespace App\Command;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:worker')]
class WorkerCommand extends Command
{
    protected static $defaultName = 'app:worker';

    private SqsClient $sqsClient;

    public function __construct(SqsClient $sqsClient)
    {
        parent::__construct();
        $this->sqsClient = $sqsClient;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueUrl = 'https://sqs.us-east-1.amazonaws.com/133831340626/carforrent_production_sendmail';
        try {
            $result = $this->sqsClient->receiveMessage(array(
                'AttributeNames' => ['SentTimestamp'],
                'MaxNumberOfMessages' => 1,
                'MessageAttributeNames' => ['All'],
                'QueueUrl' => $queueUrl, // REQUIRED
                'WaitTimeSeconds' => 0,
            ));
            if (!empty($result->get('Messages'))) {
                var_dump($result->get('Messages')[0]);
                $result = $this->sqsClient->deleteMessage([
                    'QueueUrl' => $queueUrl, // REQUIRED
                    'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle'] // REQUIRED
                ]);
            } else {
                echo "No messages in queue. \n";
            }
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
        $output->writeln('Worker received!');
        return Command::SUCCESS;
    }
}
