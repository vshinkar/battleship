<?php
/**
 * Created by PhpStorm.
 * User: valeriyshinkar
 * Date: 10/31/18
 * Time: 21:15
 */

namespace ValeriyShinkar\Models\Entities;

interface Matrix
{
    public function getWidth(): int;
    public function getHeight(): int;
}
