<?php

namespace RLB\Bundle\MakerBundle\Maker;

use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;

final class MakeDomain extends AbstractMaker
{
    public static function getCommandName() : string
    {
        return 'rlb:make:domain';
    }
}