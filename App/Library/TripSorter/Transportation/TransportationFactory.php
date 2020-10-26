<?php
declare(strict_types=1);

namespace App\Library\TripSorter\Transportation;

use App\Library\Exception\InvalidTypeException;


/**
 * Class TranspostationFactory
 *
 * @package App\Library\TripSorter\Transportation;
 */

class TransportationFactory {

    /**
     * @param string $type
     * @param array $trip
     * @return Transport
     * @throws InvalidTypeException
     */
    public static function getTransportation(string $type, array $trip):Transport {

        switch ($type) {
            case 'train' :
                return new Train($trip);
            case 'bus' :
                return new Bus($trip);
            case 'plane' :
                return new  Plane($trip);
            default:
                throw new InvalidTypeException(
                    sprintf(
                        'Unsupported transportation : %s',
                        $type
                    )
                );
        }
    }
}
