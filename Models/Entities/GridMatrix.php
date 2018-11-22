<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 21:33
 */

namespace ValeriyShinkar\Models\Entities;

use ValeriyShinkar\Models\Entities\Ship\Ship;

class GridMatrix implements Matrix
{
    protected $width;
    protected $height;
    protected $grid = [];
    protected $loop = 0;

    /**
     * GridMatrix constructor.
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return array
     */
    public function getGrid(): array
    {
        return $this->grid;
    }

    /**
     * @return array
     */
    public function createGrid()
    {
        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                $this->grid[$i][$j] = 0;
            }
        }

        return $this->grid;
    }

    /**
     * @param Ship $ship
     * @throws \Exception
     */
    public function addShip(Ship $ship)
    {
        $coord = $this->getDecksCoordinates($ship);

        $this->putShip($ship->getLength(), $coord);
    }

    /**
     * @param Ship $ship
     * @return array
     * @throws \Exception
     */
    public function getDecksCoordinates(Ship $ship)
    {
        $decks = $ship->getLength();
        $kx = $this->getRandom(1);
        $ky = ($kx == 0) ? 1 : 0;

        if ($kx == 0) {
            $x = $this->getRandom($this->width - 1);
            $y = $this->getRandom($this->height - $decks);
        } else {
            $x = $this->getRandom($this->width - $decks);
            $y = $this->getRandom($this->height - 1);
        }

        $coord = [
            'x' => $x,
            'y' => $y,
            'kx' => $kx,
            'ky' => $ky,
        ];

        $result = $this->checkLocationShip($x, $y, $kx, $ky, $decks);

        // if coordinates are not valid, run again
        if (!$result) {

            if ($this->loop > 100)
                die('Max loop!!!');

            $this->loop++;

            return $this->getDecksCoordinates($ship);
        }

        if ($ship->getType() == 'lshpaped') {
            if (!$cornerCoord = $this->getDecksCoordinatesCorner($ship->getLength(), $ship->getCornerLength(), $coord)) {
                return $this->getDecksCoordinates($ship);
            }

            $this->putShip($ship->getCornerLength(), $cornerCoord);
        }

        return $coord;

    }

    /**
     * @param int $n
     * @return int
     * @throws \Exception
     */
    public function getRandom(int $n): int
    {
        return random_int(0, $n);
    }

    /**
     * @param $x
     * @param $y
     * @param $kx
     * @param $ky
     * @param $decks
     * @return bool
     */
    public function checkLocationShip($x, $y, $kx, $ky, $decks)
    {
        //we form indexes of the beginning and end of the cycle for rows
        $fromX = ($x == 0) ? $x : $x - 1;

        // if the condition is true - it means that the ship is located vertically and its last deck is adjacent
        // to the bottom of the playing field
        // so the x coordinate of the last deck will be the end of loop index
        if ($x + $kx * $decks == $this->width && $kx == 1) {
            $toX = $x + $kx * $decks;
        }
        // the ship is located vertically and between it and the lower boundary of the playing field there is at least another
        // one line, the coordinate of this line will be the index of the end of the cycle
        else if ($x + $kx * $decks < $this->width && $kx == 1) {
            $toX = $x + $kx * $decks + 1;
        }// the ship is located horizontally along the bottom of the playing field
        else if ($x == ($this->width - 1) && $kx == 0) {
            $toX = $x + 1;
        }// the ship is horizontally somewhere in the middle of the playing field
        else if ($x < ($this->width - 1) && $kx == 0) {
            $toX = $x + 2;
        }

        // create indexes of the beginning and end of the cycle for the columns
        // the principle is the same as for strings
        $fromY = ($y == 0) ? $y : $y - 1;
        if ($y + $ky * $decks == $this->height && $ky == 1) {
            $toY = $y + $ky * $decks;
        } else if ($y + $ky * $decks < $this->height && $ky == 1) {
            $toY = $y + $ky * $decks + 1;
        } else if ($y == ($this->height - 1) && $ky == 0) {
            $toY = $y + 1;
        } else if ($y < ($this->height - 1) && $ky == 0) {
            $toY = $y + 2;
        }

        if (!isset($toX) || !isset($toY)) {
            return false;
        }

        for ($i = $fromX; $i < $toX; $i++) {
            for ($j = $fromY; $j < $toY; $j++) {
                if ($this->grid[$i][$j] == 1) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Calculate corner coordinates
     * @param int $decks
     * @param int $corner
     * @param array $coord
     * @return bool|mixed
     * @throws \Exception
     */
    public function getDecksCoordinatesCorner(int $decks, int $corner, array $coord)
    {
        $arr = [];
        $kx = ($coord['kx'] == 0) ? 1 : 0;
        $ky = ($coord['ky'] == 0) ? 1 : 0;

        //get first and last coordinates
        $i = 0;
        while ($i < $decks) {

            if (!$i || $i + 1 == $decks)
                $arr[] = [
                    'x' => $coord['x'] + $i * $coord['kx'],
                    'y' => $coord['y'] + $i * $coord['ky'],
                    'kx' => $kx,
                    'ky' => $ky,
                ];

            $i++;
        }

        $rand = $this->getRandom(1);
        $reserved = ($rand == 1) ? 0 : 1;

        //check if possible to add corner
        if (!$result = $this->checkLocationShip($arr[$rand]['x'], $arr[$rand]['y'], $arr[$rand]['kx'], $arr[$rand]['ky'], $corner)) {

            //try with another corner;
            if (!$result = $this->checkLocationShip($arr[$reserved]['x'], $arr[$reserved]['y'], $arr[$reserved]['kx'], $arr[$reserved]['ky'], $corner)) {
                return false;
            } else {
                return $arr[$reserved];
            }

        } else {
            return $arr[$rand];
        }

        return false;
    }

    /**
     * Put ship into the grid
     * @param int $decks
     * @param array $coord
     */
    public function putShip(int $decks, array $coord)
    {

        $i = 0;
        while ($i < $decks) {
            $this->grid[$coord['x'] + $i * $coord['kx']][$coord['y'] + $i * $coord['ky']] = 1;

            $i++;
        }

    }

}