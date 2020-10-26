<?php
declare(strict_types=1);

namespace App\Library\TripSorter\Transportation;

/**
 * Class Transport
 *
 * @package App\Library\TripSorter\Transportation;
 */
abstract class Transport
{
    public $type;
    public $number;
    public $departure;
    public $arrival;

    public function __construct($trip)
    {
        $this->type = $trip['type'];
        $this->number = $trip['number'] ?? null;
        $this->departure = $trip['departure'];
        $this->arrival = $trip['arrival'];
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }
}