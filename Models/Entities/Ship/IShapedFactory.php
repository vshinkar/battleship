<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 19:24
 */

namespace ValeriyShinkar\Models\Entities\Ship;

/**
 * I-shaped factory
 */
class IShapedFactory extends ShipFactory
{

    /**
     * @param int $length
     * @return IShapedShip|Ship
     */
    public function getShip(int $length)
    {
        return new IShapedShip($length);
    }
}
