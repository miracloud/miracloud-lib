<?php

namespace miraCloud\lib;

class Helper
{
    /**
     * Convert a CSV file into an Array
     *
     * @return array
     */
    public static function convertCsvToArray($file, $separator = ';', $delimit = '"') : array
    {
        if (($handle = fopen($file, 'r'))) {
            $data = [];
            $i = 0;
            while (($row = fgetcsv($handle, 0, $separator, $delimit))) {
                $j = 0;
                foreach ($row as &$col) {
                    $data[$i][$j++] = $col;
                }
                ++$i;
            }
            fclose($handle);
        }
        return $data;
    }

    /**
     * Convert an Array into a CSV file
     *
     * @return void
     */
    public static function convertArrayToCsv(array $data, $file, $separator = ';', $delimit = '"') : void
    {
        $fd = fopen($file, 'w');
        foreach ($data as &$row) {
            foreach ($row as &$col) {
                $col = $delimit.rtrim(str_replace('<br />', ', ', strip_tags($col, '<br>')), " \t\n\r\0\x0B,").$delimit;
            }
            fwrite($fd, implode($separator, $row)."\r\n");
            unset($row);
        }
        fclose($fd);
    }
}
