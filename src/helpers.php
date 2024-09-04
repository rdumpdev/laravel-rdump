<?php

use RDumpDev\RDump\RDump;

if (!function_exists('rdump')) {
    function rdump(string $action, mixed $data): void
    {
        RDump::dump($action, $data);
    }
}
