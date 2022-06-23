<?php

namespace App\Command;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:producer')]
class ProducerCommand extends Command
{
    private SqsClient $sqsClient;

    public function __construct(SqsClient $sqsClient, string $name = null)
    {
        parent::__construct($name);
        $this->sqsClient = $sqsClient;
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $params = [
            'MessageBody' => "Information about current NY Times fiction bestseller for week of 12/11/2016.",
            'QueueUrl' => 'https://sqs.us-east-1.amazonaws.com/133831340626/carforrent_production_sendmail'
        ];

        try {
            $result = $this->sqsClient->sendMessage($params);
            var_dump($result);
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
        $output->writeln('Producer send!');
        return Command::SUCCESS;
    }
}
