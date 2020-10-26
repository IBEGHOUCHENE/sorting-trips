<?php
use App\Library\ParserJson\Reader\Json;
use PHPUnit\Framework\TestCase;
/**
 * Class JsonTest
 *
 * @package tests\ParserJson\Reader
 */

class JsonTest extends TestCase {

    public function testGetArrayByJsonFile(): void
    {
        $parser = new Json();
        $sourceFile = realpath('sourcefile/voyage1.json');
        $data = $parser::getArrayByJsonFile($sourceFile);
        $this->assertTrue(is_array($data));
    }
}
