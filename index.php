<?php
// Define path to source directory
defined('SOURCE_FILE_PATH') || define('SOURCE_FILE_PATH', __DIR__ . '/sourcefile/');
require "vendor/autoload.php";

use App\Library\TripSorter\Transportation\Transport;
use App\Library\TripSorter\TripSorter;

// Load File Json source
// $sourceFile = SOURCE_FILE_PATH . 'voyage2.json';
 $sourceFile = SOURCE_FILE_PATH . 'voyage1.json';

$JsonParser = new App\Library\ParserJson\Reader\Json();
$tripCollection = $JsonParser::getArrayByJsonFile($sourceFile);

$tripSorter = new TripSorter($tripCollection);
$transportation = $tripSorter->sortTripCollection()->getTransportation();
?>
<html lang="en">
<head></head>
<body>
<table width="50%" border="1" bordercolor="blue" style="margin-left:auto;margin-right:auto;margin-top:50px">
    <tr>
        <th align="left">type</th>
        <th align="left">transport_number</th>
        <th align="left">departure_date</th>
        <th align="left">arrival_date</th>
    </tr>
    <?php
    /* @var  Transport $trip */
    foreach ($transportation as $trip) { ?>
        <tr>
            <td><?php echo $trip->getType(); ?></td>
            <td><?php echo $trip->getNumber(); ?></td>
            <td><?php echo $trip->getDeparture(); ?></td>
            <td><?php echo $trip->getArrival(); ?></td>
        </tr>
    <?php } ?>

</table>
</body>
</html>

    




