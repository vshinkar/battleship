<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 19:24
 */

namespace ValeriyShinkar\Models\Entities\Ship;

/**
 * L-shaped ship
 */
class LShapedShip extends BaseShip
{
    protected $type = 'lshpaped';
    protected $cornerLength;

    public function __construct(int $length, int $cornerLength = 1)
    {
        $this->cornerLength = $cornerLength;

        parent::__construct($length);
    }

    /**
     * Return ship corner length
     * @return int|int
     */
    public function getCornerLength(): int
    {
        return $this->cornerLength + 1;
    }

    /**
     * Return ship length
     * @return int|int
     */
    public function getLength(): int
    {
        return $this->length - $this->cornerLength;
    }

}