<?php

if(!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed  $args
     * @return void
     */
    function dd()
    {
        array_map(function($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

if(!function_exists('xml_encode')) {
    /**
     * @param $data
     * @param $isFirst
     * @return string
     */
    function xml_encode($data, $isFirst = true): string
    {
        $xml = ($isFirst) ? '<?xml version="1.0" encoding="UTF-8"?>' : '';
        $isFirst = false;
        foreach ($data as $key => $value) {
            if ( is_numeric($key) ) {
                $key = 'item';
            }

            if (is_array($value)) {
                $xml .= '<' . $key . '>' . xml_encode($value, $isFirst) . '</' . $key . '>';
            } else {
                $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
            }
        }

        return $xml;
    }
}