<?php

namespace RLB\Bundle\MakerBundle;

use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Generator
 */
class RlbGenerator
{
    private $fileLocator;

    /**
     * Constructor
     *
     * @param FileLocator $fileLocator
     */
    public function __construct(FileLocator $fileLocator)
    {
        $this->fileLocator = $fileLocator;
    }

    /**
     * getRootApp
     *
     * @return sting
     */
    public function getRootApp(): string
    {
        $resourcePath = $this->fileLocator->locate('Kernel.php');

        return dirname($resourcePath);
    }

    /**
     * generateFolder
     *
     * @param string $targetPath
     * @param string $folderSource
     *
     * @return void
     */
    public function generateFolder(string $targetPath, string $folderSource)
    {
        $fileSystem = new Filesystem();

        $fileSystem->mirror($folderSource, $this->getRootApp().'/'.$targetPath);
    }
}
