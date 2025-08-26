<?php

declare(strict_types=1);

namespace Boson\Component\Saucer;

final readonly class Launch
{
    public const int SAUCER_LAUNCH_SYNC = 0;
    public const int SAUCER_LAUNCH_ASYNC = 1;

    private function __construct() {}
}
