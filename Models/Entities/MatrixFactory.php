<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 21:34
 */

namespace ValeriyShinkar\Models\Entities;

class MatrixFactory
{
    public static function makeMatrix($width, $height): Matrix
    {
        return new GridMatrix($width, $height);
    }
}