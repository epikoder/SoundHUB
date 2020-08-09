<?php

namespace App\Http\Controllers\WEB\Payment;

use stdClass;

trait Objectify
{
    public function objectify(array $array)
    {
        $object = new stdClass;
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $object->$key = new stdClass;
                foreach ($value as $innerKey => $innerValue) {
                    if (is_array($innerValue)) {
                        $object->$key->$innerKey = new stdClass;
                        foreach ($innerValue as $innerKey2 => $innerValue2) {
                            $object->$key->$innerKey->$innerKey2 = $innerValue2;

                            if (is_array($innerValue2)) {
                                $object->$key->$innerKey->$innerKey2 = new stdClass;
                                foreach ($innerValue2 as $innerKey3 => $innerValue3) {
                                    $object->$key->$innerKey->$innerKey2->$innerKey3 = $innerValue3;
                                }
                            } else {
                                $object->$key->$innerKey->$innerKey2 = $innerValue2;
                            }
                        }
                    } else {
                        $object->$key->$innerKey = $innerValue;
                    }
                }
            } else {
                $object->$key = $value;
            }
        }
        return $object;
    }
}
