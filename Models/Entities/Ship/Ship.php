<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 19:22
 */

namespace ValeriyShinkar\Models\Entities\Ship;

/**
 * Ship
 */
interface Ship
{
    /**
     * Return Ship length
     * @return int
     */
    public function getLength(): int;

    /**
     * Return Ship type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Return Ship name
     *
     * @return string
     */
    public function getName(): string;
}
