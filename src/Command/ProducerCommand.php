<?php

namespace App\Command;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsCommand(name: 'app:producer')]
class ProducerCommand extends Command
{
    private SqsClient $sqsClient;
    private ContainerBagInterface $params;

    public function __construct(SqsClient $sqsClient, ContainerBagInterface $params, string $name = null)
    {
        parent::__construct($name);
        $this->sqsClient = $sqsClient;
        $this->params = $params;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sqsUrl = $this->params->get('sqsUrl');
        $params = [
            'MessageBody' => "producer Jackie created this message!!!",
            'QueueUrl' => $sqsUrl
        ];
        try {
            $this->sqsClient->sendMessage($params);
        } catch (AwsException $e) {
            error_log($e->getMessage());
        }
        $output->writeln('Producer send!');

        return Command::SUCCESS;
    }
}
