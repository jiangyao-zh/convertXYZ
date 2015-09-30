<?php
    //GCJ-02(火星，高德) 坐标转换成 BD-09(百度) 坐标
      //@param bd_lon 百度经度
    //@param bd_lat 百度纬度
    function bd_encrypt($gg_lon,$gg_lat)
    {
        $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $gg_lon;
        $y = $gg_lat;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $data['bd_lon'] = $z * cos($theta) + 0.0065;
        $data['bd_lat'] = $z * sin($theta) + 0.006;
        return $data;
    }
    //BD-09(百度) 坐标转换成  GCJ-02(火星，高德) 坐标
      //@param bd_lon 百度经度
    //@param bd_lat 百度纬度
    function bd_decrypt($bd_lon,$bd_lat)
    {
        $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $bd_lon - 0.0065;
        $y = $bd_lat - 0.006;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $data['gg_lon'] = $z * cos($theta);
        $data['gg_lat'] = $z * sin($theta);
        return $data;
    }
    //测试
    $bd = bd_encrypt(108.947903,34.231966);
    //输出：array(2) { ["bd_lon"]=> float(108.954466795) ["bd_lat"]=> float(34.2376965936) }
    $gg = bd_decrypt(108.95434,34.238235);
    //输出：array(2) { ["gg_lon"]=> float(108.947903625) ["gg_lat"]=> float(34.2319662425) }
?> 