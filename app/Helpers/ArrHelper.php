<?php

if (! function_exists('to_assoc_array')) {
    // use this helper function to extract any data
    // as key value array/associative array (array that have index/key with string type)
    function to_assoc_array($arr)
    {
        $assoc = [];
        foreach($arr as $data) {
            $assoc[$data->key] = $data;
        }
        return $assoc;
    }
}


if (! function_exists('extract_location_coordinate')) {
    // use this helper function to extract location coordinate data
    // as key value array/associative array (array that have index/key with string type)
    // when you store your coordinate data on json_decode(array) e.g  '[1.111, 124.111]'
    function extract_location_coordinate($location)
    {
        $data_location = json_decode($location);
        $assoc = [];
        $assoc_key = '';
        foreach($data_location as $index => $data) {
            if ($index == 0) $assoc_key = 'lat';
            elseif ($index == 1) $assoc_key = 'lng';
            else $assoc_key = 'undefined';
            $assoc[$assoc_key] = $data;
        }
        return (Object)$assoc;
    }
}