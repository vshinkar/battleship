<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 19:18
 */

namespace ValeriyShinkar\Models\Entities\Ship;

abstract class ShipFactory
{

    /**
     * @param string $type
     * @return IShapedFactory|LShapedFactory
     * @throws \Exception
     */
    public static function getFactory(string $type)
    {
        switch ($type) {
            case 'lshpaped':
                return new LShapedFactory();
            case 'ishpaped':
                return new IShapedFactory();
        }
        throw new \Exception('Bad config');
    }

    /**
     * Return ship
     *
     * @param int $length
     * @return mixed
     */
    abstract public function getShip(int $length);
}