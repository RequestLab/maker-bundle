<?php

namespace RLB\Bundle\MakerBundle\Maker;

use RLB\Bundle\MakerBundle\RlbGenerator;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\DependencyBuilder;

/**
 * MakeDomain
 *
 * @uses AbstractMaker
 */
final class MakeDomain extends AbstractMaker
{
    /**
     * Constructor
     *
     * @param RlbGenerator $generator
     */
    public function __construct(RlbGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * getCommandName
     *
     * @return string
     */
    public static function getCommandName() : string
    {
        return 'rlb:make:domain';
    }

    /**
     * configureCommand
     *
     * @param Command            $command
     * @param InputConfiguration $inputConf
     *
     * @return void
     */
    public function configureCommand(Command $command, InputConfiguration $inputConf)
    {
        $command
            ->setDescription('Creates a new domain for project')
            ->addArgument('name', InputArgument::OPTIONAL, sprintf('Domain name to create (e.g. <fg=yellow>%s</>)', Str::asClassName(Str::getRandomTerm())))
            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/MakeDomain.txt'))
        ;
    }

    /**
     * generate
     *
     * @param InputInterface $input
     * @param ConsoleStyle   $io
     * @param Generator      $generator
     *
     * @return void
     */
    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $options = [
            'name' => $input->getArgument('name'),
        ];

        $src = __DIR__."/../Resources/skeleton/domain/";  // source folder or file

        $domainName = ucfirst($options['name']);

        $this->generator->generateFolder('./'.$domainName, $src);

        $this->writeSuccessMessage($io);
    }

    /**
     * configureDependencies
     *
     * @param DependencyBuilder $dependencies
     *
     * @return void
     */
    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}