<?php

namespace Quartetcom\RayDiSample\Command;

use Psr\Log\LoggerInterface;
use Quartetcom\RayDiSample\Greeter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GreetingCommand extends Command
{
    const NAME = 'demo:greet';

    /**
     * @var Greeter
     */
    private $greeter;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Greeter $greeter
     * @param LoggerInterface $logger
     */
    public function __construct(Greeter $greeter, LoggerInterface $logger)
    {
        $this->greeter = $greeter;
        $this->logger = $logger;

        parent::__construct(self::NAME);
    }

    protected function configure()
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, '挨拶する相手の名前')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $greeting = $this->greeter->greet($input->getArgument('name'));

        $this->logger->info($greeting);

        $output->writeln($greeting);
    }
}
