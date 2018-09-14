<?php

namespace miraCloud\Tests;

use miraCloud\lib\Helper;

class HelperTest extends \PHPUnit\Framework\TestCase
{
    public function test_convertCsvToArray_is_not_empty()
    {
        print_r(Helper::convertCsvToArray('files/example.csv'));
        exit();
        $this->assertNotEmpty(Helper::convertCsvToArray('files/example.csv'));
    }

    public function test_convertArrayToCsv_is_not_empty()
    {
        $route = 'files/test.csv';

        $array = [
            [
                'test', 'test2'
            ],
            [
                'test3','test4'
            ]
        ];

        Helper::convertArrayToCsv($array, $route);

        $this->assertFileExists($route);
    }
}
