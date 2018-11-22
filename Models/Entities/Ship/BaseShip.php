<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 19:24
 */

namespace ValeriyShinkar\Models\Entities\Ship;

/**
 * Base ship
 */
class BaseShip implements Ship
{
    protected $length;
    protected $type;

    public function __construct(int $length)
    {
        $this->length = $length;
    }

    /**
     * Return ship length
     * @return int|int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Return ship type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Return ship name
     *
     * @return string
     */
    public function getName(): string
    {
        return "The {$this->getType()} ship name with length {$this->getLength()}";
    }
}
