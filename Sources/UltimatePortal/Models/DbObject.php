<?php

namespace UltimatePortal\Models;

abstract class DbObject {
    public ?int $dbId;
    function __construct(int $dbId = 0) {
        $this->dbId = $dbId;
    }
}