<?php
declare(strict_types=1);
namespace App\Library\TripSorter;

use App\Library\Exception\InvalidTypeException;
use App\Library\TripSorter\Transportation\TransportationFactory;

/**
 * Class TripSorter
 *
 * @package Library\TripSorter
 */
class TripSorter
{

    /**
     * Array of trips
     *
     * @var array
     */
    private $tripCollection;

    public function __construct(array $tripCollection)
    {
        $this->tripCollection = $tripCollection;
    }

    /**
     * Get the collection Trips
     *
     * @return array
     */
    public function getTripCollection()
    {
        return $this->tripCollection;
    }

    /**
     * Set the collection Trips
     * @param array $trpCollection
     */
    public function setTripCollection(array $trpCollection)
    {
        $this->tripCollection = $trpCollection;
    }

    /**
     * Extract the first Trip
     *
     * @param array $tripCollection
     * @return array
     */
    public function extractFirstTrip(array $tripCollection): array
    {
        $firstTrip = [];
        $departureList = array_column($tripCollection, 'departure');
        $arrivalList = array_column($tripCollection, 'arrival');
        $departure = array_diff($departureList, $arrivalList);
        $departure = array_values($departure);

        foreach ($tripCollection as $trip) {
            if (in_array($departure[0], $trip)) {
                $firstTrip = $trip;
            }
        }
        return $firstTrip;
    }

    /**
     * Sort a trip collection from departure to arrival
     */

    public function sortTripCollection()
    {
        $sizeCollection = count($this->tripCollection);
        $tripCollectionOrdered = array();

        while (count($tripCollectionOrdered) < $sizeCollection) {
            $firstTrip = $this->extractFirstTrip($this->getTripCollection());
            $tripCollectionOrdered [] = $firstTrip;
            unset($this->tripCollection[array_search($firstTrip, $this->getTripCollection())]);
        }
        $this->setTripCollection($tripCollectionOrdered);
        return $this;
    }

    /**
     * Get sorted transportation as an array of objects
     *
     * @return array
     */
    public function getTransportation()
    {
        $transportationFactory = new  TransportationFactory();
        $transportationList = [];
        if (count($this->tripCollection) == 0) {
            return $transportationList;
        }
        foreach ($this->tripCollection as $trip) {
            $type = strtolower($trip['type']);
            try {
                $transportationList[] = $transportationFactory->getTransportation($type, $trip);
            } catch (InvalidTypeException $e) {
                echo 'Ligne ', $e->getLine(), ' in ', $e->getFile(), ' Exception thrown : ', $e->getMessage();
            }
        }
        return $transportationList;
    }
}
