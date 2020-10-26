<?php
use App\Library\TripSorter\Transportation\Transport as TransportAlias;
use App\Library\TripSorter\TripSorter;
use PHPUnit\Framework\TestCase;

/**
 * Class TripSorterTest
 *
 * @package tests\Library\TripSorter\Transportation;
 */
class TripSorterTest extends TestCase
{
    protected $tripSorter;
    protected $transportationFactory;
    /**
     * @var string[][]
     */
    protected $tripCollection = [
        [
            'type' => 'plane',
            'number' => '11A',
            'departure' => 'C',
            'arrival' => 'D',
            'seat' => '10A',
            'gate' => '10A',
        ],
        [
            'type' => 'train',
            'departure' => 'A',
            'arrival' => 'B',
        ],
        [
            'type' => 'bus',
            'departure' => 'B',
            'arrival' => 'C',
        ],
    ];

    /**
     * @var string[]
     */
    protected $firstTrip = [
        'type' => 'train',
        'departure' => 'A',
        'arrival' => 'B',
    ];

    /**
     * @var string[][]
     */
    protected $expectedTripCollection = [
        [
            'type' => 'train',
            'departure' => 'A',
            'arrival' => 'B',
        ],
        [
            'type' => 'bus',
            'departure' => 'B',
            'arrival' => 'C',
            'number' => '11A',
        ],
        [
            'type' => 'plane',
            'departure' => 'C',
            'arrival' => 'D',
            'seat' => '10A',
            'gate' => '10A',
        ],
    ];

    public function setUp(): void
    {
        $this->tripSorter = new TripSorter($this->tripCollection);
    }

    public function testGetFirstTrip()
    {
        $fistTripInCollection = $this->tripSorter->extractFirstTrip($this->tripCollection);
        $this->assertTrue($this->areSimilarTrip($fistTripInCollection, $this->firstTrip));
    }

    public function testSortCollectionTrips()
    {
        $sortedCollection = $this->tripSorter->sortTripCollection()->getTripCollection();
        $this->assertTrue($this->areSimilarCollectionTrips($this->expectedTripCollection, $sortedCollection));
    }


    public function testGetTransportation()
    {
        $transportation = $this->tripSorter->getTransportation();

        /** @var TransportAlias $type */
        foreach ($transportation as $type)
            $this->assertInstanceOf('App\Library\TripSorter\Transportation\Transport', $type);
    }

    /**
     * Determine if two associative arrays are similar
     *
     * Both arrays must have the same indexes with identical values
     * without respect to key ordering
     *
     * @param array $a
     * @param array $b
     * @return bool
     */
    private function areSimilarTrip(array $a, array $b)
    {
        // if the indexes don't match, return immediately
        if (count(array_diff_assoc($a, $b))) {
            return false;
        }
        // we know that the indexes, but maybe not values, match.
        // compare the values between the two arrays
        foreach ($a as $k => $v) {
            if ($v !== $b[$k]) {
                return false;
            }
        }
        // we have identical indexes, and no unequal values
        return true;
    }

    /**
     * @param $expectedCollection
     * @param $sortedCollection
     * @return bool
     */
    private function areSimilarCollectionTrips(array $expectedCollection, array $sortedCollection)
    {
        foreach ($sortedCollection as $key => $collection)
            if ($expectedCollection[$key]['departure'] != $collection['departure'])
                return false;
        return true;
    }
}


