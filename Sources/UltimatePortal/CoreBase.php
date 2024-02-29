<?php

namespace UltimatePortal;

abstract Class CoreBase {
    protected Caller $upCaller;
    function __construct()
    {
        global $upCaller;
        $this->upCaller = $upCaller;
    }

    const filesAutoLoad = [
        'Subs.php',
        'Load.php',
        'SubsBlocks.php',
        'SubsUtils.php',
    ];
}