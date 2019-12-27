<?php

namespace App\Helpers;

use Carbon\Carbon;

if(! function_exists('toJalali')){
    /**
     * @param Carbon $date
     * @return Carbon
     */
    function toJalali(Carbon $date = null){
        if($date == null){
            $date = jdate();
        }
        return Carbon::parse($date);
    }
    function normalPrice($price, $area, $age, $position, $floor, $allFloors, $unitsInFloor, $hasElevator, $hasParking){
        $lowPrice = 12000000;
        $highPrice = 16000000;
        $normalArea = 100;
        $normalAge = 1398;
        $normalFloor = 3;
        $normalAllUnits = 8;
        $reduceForPosition = $position > 4 ? 0.05 : 0;
        $reduceForFloor = 0;
        $reduceForUnit = 0;
        if($allFloors >= $normalFloor){
            if($floor == 1){
                $reduceForFloor = 0.02;
            } else if($floor == $allFloors){
                $reduceForFloor = -0.02;
            } else if($floor == $allFloors - 1 && $allFloors > $normalFloor){
                $reduceForFloor = -0.02;
            }
            if(!$hasElevator && $floor > 2){
                $reduceForFloor += 0.15;
            }
        }
        $n = 1;
        switch ($unitsInFloor){
            case 1:
                $n = 1;
                break;
            case 2:
                $n = 2;
                break;
            case 3:
                $n = 3;
                break;
            case 4:
                $n = 4;
                break;
            default:
                $n = 5;
                break;
        }
        $reduceForUnit = ($n -1) * 0.03;
        $reduceForElevator = $hasElevator ? 0 : 0.1;
        $reduceForParking = $hasParking ? 0 : 0.1;
        $reduceForAllUnits = ($n * $allFloors) > 8 ? (($n * $allFloors) - 8) * 0.012 : 0;
        $normalPrice = $price * (1 - (($area - $normalArea) * 0.0015) - (($normalAge - $age) * 0.02) - ($reduceForPosition) - ($reduceForFloor) - ($reduceForUnit) - ($reduceForElevator) - ($reduceForParking) - ($reduceForAllUnits));
        return [
            'price' => $normalPrice * $area,
            'low_price' => $lowPrice,
            'normal_price' => $normalPrice,
            'high_price' => $highPrice,
            'is_low' => ($price < $normalPrice),
            'is_normal' => ($lowPrice <= $price && $price < $highPrice),
            'is_high' => ($price >= $highPrice)
        ];
    }

}
