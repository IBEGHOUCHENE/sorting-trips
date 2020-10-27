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
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $number;
    /**
     * @var string
     */
    public $departure;
    /**
     * @var string
     */
    public $arrival;

    public function __construct(array $trip)
    {
        $this->type = $trip['type'];
        $this->number = $trip['number'] ?? null;
        $this->departure = $trip['departure'];
        $this->arrival = $trip['arrival'];
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getNumber():string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getDeparture():string
    {
        return $this->departure;
    }

    /**
     * @return string
     */
    public function getArrival():string
    {
        return $this->arrival;
    }
}