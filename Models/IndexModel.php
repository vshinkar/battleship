<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 14:02
 */

namespace ValeriyShinkar\Models;

use ValeriyShinkar\Core\Model;
use ValeriyShinkar\Models\Entities\MatrixFactory;
use ValeriyShinkar\Models\Entities\Ship\ShipFactory;

class IndexModel extends Model
{

    public function getData()
    {

        // build grid
        $matrix = MatrixFactory::makeMatrix(Config::getItem('width'), Config::getItem('height'));
        $matrix->createGrid();

        // add ships to grid
        foreach (Config::getItem('ship') as $type => $values) {

            foreach ($values as $val) {

                $i = 1;
                do {

                    $ship = ShipFactory::getFactory($type)->getShip($val['length']);

                    $matrix->addShip($ship);

                    $i++;
                } while ($i <= $val['total']);

            }

        }

        return $matrix->getGrid();
    }
}