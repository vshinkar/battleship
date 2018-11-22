<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 19:24
 */

namespace ValeriyShinkar\Models\Entities\Ship;

/**
 * L-shaped factory
 */
class LShapedFactory extends ShipFactory
{

    /**
     * @param int $length
     * @return LShapedShip|Ship
     */
    public function getShip(int $length)
    {
        return new LShapedShip($length);
    }
}
