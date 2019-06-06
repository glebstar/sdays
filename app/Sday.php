<?php

namespace App;
use Cache;

class Sday
{
    public static function getResult($cityId)
    {
        $result = [
            'his' => 0,
            'month' => 0,
            'curr' => 0,
        ];

        if (Cache::has('res_city_' . $cityId)) {
            $result = Cache::get('res_city_' . $cityId);
        } else {
            $cloudVal = 0.5;

            PdoDb::getOne('SET @num = 0');
            $result['his'] = PdoDb::getOne('
            SELECT max(cnum) FROM ( 
                SELECT count(num) as cnum FROM (
                    SELECT
                        CASE 
                        WHEN (exists(SELECT 1 FROM cloud_covers t2 WHERE t2.date = t.date + INTERVAL 1 day AND t2.value <= ? AND t2.city_id = ?)) 
                        THEN @num
                        ELSE @num:=@num+1 END as num
                    FROM `cloud_covers` t
                    WHERE t.value <= ? AND t.city_id = ?
                    ) t3
                GROUP BY num
            ) t4
        ', [$cloudVal, $cityId, $cloudVal, $cityId]);

            $dateStartMonth = date('Y-m-d', strtotime( 'first day of ' . date( 'F Y')));
            $result['month'] = PdoDb::getOne('
            SELECT max(cnum) FROM ( 
                SELECT count(num) as cnum FROM (
                    SELECT
                        CASE 
                        WHEN (exists(SELECT 1 FROM cloud_covers t2 WHERE t2.date = t.date + INTERVAL 1 day AND t2.value <= ? AND t2.city_id = ? AND t2.date BETWEEN ? AND ?)) 
                        THEN @num
                        ELSE @num:=@num+1 END as num
                    FROM `cloud_covers` t
                    WHERE t.value <= ? AND t.city_id = ? AND t.date BETWEEN ? AND ?
                    ) t3
                GROUP BY num
            ) t4
        ', [$cloudVal, $cityId, $dateStartMonth, date('Y-m-d'),  $cloudVal, $cityId, $dateStartMonth, date('Y-m-d')]);

            $currTime = time();
            do {
                $num = PdoDb::getOne('SELECT value FROM cloud_covers WHERE date = ? AND value <= ? AND city_id = ?', [date('Y-m-d', $currTime), $cloudVal, $cityId]);
                $currTime -= 86400;
                if ($num) {
                    $result['curr']++;
                }
            } while ($num);

            Cache::put('res_city_' . $cityId, $result, 60);
        }

        return $result;
    }
}
