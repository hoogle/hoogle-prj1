<?
  //$abs_filename = "/mnt/photos/DSC00492.JPG";
  $exif = exif_read_data($abs_filename, 'EXIF', 0);
  $supported_exif = array(
                           "GPSLatitudeRef" => "拍照位置",
                           "Make" => "相機",
                           "FNumber" => "光圈",
                           "ExposureTime" => "快門",
                           "FocalLength" => "焦距",
                           "MeteringMode" => "測光模式",
                           "ExposureProgram" => "拍攝模式",
                           "ExposureMode" => "曝光模式",
                           "ExposureBiasValue" => "曝光補償(EV)",
                           "WhiteBalance" => "白平衡",
                           "SceneCaptureType" => "拍攝場景",
                           "ISOSpeedRatings" => "ISO值",
                           "DateTimeOriginal" => "拍攝時間",
                           "Flash" => "閃光燈",
                           "MaxApertureValue" => "鏡頭最大光圈",
                           "XResolution" => "X 解析度",
                           "YResolution" => "Y 解析度",
                           "ResolutionUnit" => "解析度單位",
                           "ExifVersion" => "EXIF 版本",
                           "Orientation" => "影像方向",
                           "Software" => "軟體",
                           "YCbCrPositioning" => "YCbCr 定位",
                           "LightSource" => "光線來源",
                           "ColorSpace" => "色彩頻譜空間",
                           "ExifImageWidth" => "影像寬度",
                           "ExifImageLength" => "影像高度",
                           "DateTime" => "最近變更時間",
                         );
                       
  # EXIF value definition
  $replace_array = array(
                            "Orientation" => array(
                              1 => "水平(一般)",
                              2 => "水平鏡像",
                              3 => "旋轉180度",
                              4 => "垂直鏡像",
                              5 => "水平鏡像後再逆時針轉90度",
                              6 => "逆時針轉90度",
                              7 => "水平鏡像後再順時針轉90度",
                              8 => "順時針轉90度" 
                             ),

                            "ColorSpace" => array(
                              1 => "sRGB",
                              65535 => "無法測定" 
                             ),

                            "ExposureProgram" => array(
                              0 => "未定義",
                              1 => "手動",
                              2 => "自動",
                              3 => "光圈先決",
                              4 => "快門先決",
                              5 => "景深先決",
                              6 => "運動模式",
                              7 => "肖像模式",
                              8 => "風景模式" 
                             ),

                            "MeteringMode" => array(
                              0 => "未知",
                              1 => "平均",
                              2 => "中央重點平均測光",
                              3 => "重點測光",
                              4 => "分區測光",
                              5 => "評價測光",
                              6 => "局部測光",
                              255 => "其他" 
                             ),

                            "LightSource" => array(
                              0 => "未知",
                              1 => "日光",
                              2 => "螢光燈",
                              3 => "鎢絲燈",
                              4 => "閃光燈",
                              9 => "晴天",
                              10 => "陰天",
                              11 => "陰影",
                              12 => "日光螢光燈",
                              13 => "晝光色螢光燈",
                              14 => "冷色螢光燈",
                              15 => "白色螢光燈",
                              17 => "標準燈光A",
                              18 => "標準燈光B",
                              19 => "標準燈光C",
                              20 => "D55",
                              21 => "D65",
                              22 => "D75",
                              23 => "D50",
                              24 => "ISO攝影棚鎢絲燈",
                              255 => "其他光源"
                             ),

                            "Flash" => array(
                              0 => "關閉",
                              1 => "開啟",
                              5 => "未偵測到頻閃光線",
                              7 => "已偵測到頻閃光線",
                              9 => "開啟(強制模式)",
                              13 => "開啟(強制模式/不探測返回光線)",
                              15 => "開啟(強制模式/探測返回光線)",
                              16 => "關閉(強制模式)",
                              24 => "關閉(自動模式)",
                              25 => "開啟(自動模式)",
                              29 => "開啟(自動模式/不探測返回光線)",
                              31 => "開啟(自動模式/探測返回光線)",
                              32 => "無此功能",
                              65 => "開啟(防紅眼模式)",
                              69 => "開啟(防紅眼模式/不探測返回光線)",
                              71 => "開啟(防紅眼模式/探測返回光線)",
                              73 => "開啟(強制模式/防紅眼)",
                              77 => "開啟(防紅眼模式/不探測返回光線)",
                              79 => "開啟(防紅眼模式/探測返回光線)",
                              89 => "開啟(自動模式/防紅眼)",
                              93 => "開啟(自動模式/防紅眼/不探測返回光線)",
                              95 => "開啟(自動模式/防紅眼/探測返回光線)" 
                             ),

                            "ExposureMode" => array(
                              0 => "自動曝光",
                              1 => "手動曝光",
                              2 => "Auto bracket" 
                             ),

                            "WhiteBalance" => array(
                              0 => "自動白平衡",
                              1 => "手動白平衡" 
                             ),

                            "SceneCaptureType" => array(
                              0 => "標準",
                              1 => "風景",
                              2 => "人像",
                              3 => "夜間" 
                             ),

                            "ResolutionUnit" => array(
                              2 => "英吋",
                              3 => "厘米" 
                             ),

                            "YCbCrPositioning" => array(
                              1 => "Centered",
                              2 => "Co-sited" 
                             )
     );

  function convert($key, $exif)
  {
    $compute_array = array(
      "ExposureTime" => 1,
      "FNumber" => 1,
      "FocalLength" => 1,
      "MaxApertureValue" =>1,
      "XResolution" =>1,
      "YResolution" =>1, 
      "Make" => 1,
      "ExposureBiasValue" => 1,
      "GPSLatitudeRef" => 1,
    );

    if(!$compute_array[$key])
      return -1;

    switch($key)
    {
      # 分數 < 1
      case "ExposureTime":
        $unit = "秒";
        $arr = explode("/",$exif[$key]);
        if(count($arr) != 2)
          return $exif[$key];
        if($arr[0] !=0)
        {
          $val = $arr[1] / $arr[0];
          if($val < 1)
          {
            if($arr[1] !=0)
              return $arr[0] / $arr[1] . $unit;
            else
              return "Not a number";
          }
          else return "1/$val" . $unit;
        }
        else
          return "Not a number";
        break;
      # 分數 > 1 or 直接除
      case "ExposureBiasValue":
        $number_format = 1;
      case "FNumber":
      case "FocalLength":
      case "MaxApertureValue":
      case "XResolution":
      case "YResolution":
        $arr = explode("/",$exif[$key]);
        if(count($arr) != 2)
          return $exif[$key];
        if($arr[1] !=0)
          if($number_format)
            return number_format($arr[0] / $arr[1], 2, '.', '');
          else
            return $arr[0] / $arr[1];
        else
          return "Not a number";
        break;
      # merge Make & Model
      case "Make":
        return $exif[Model]." ( ".$exif[$key]." )";
        break;
      case "GPSLatitudeRef":
        $lat = $exif['GPSLatitude'];
        $lng = $exif['GPSLongitude'];
        $lat_value = calc_faction($lat[0]) + calc_faction($lat[1]) / 60 + calc_faction($lat[2]) / 3600;
        $lng_value = calc_faction($lng[0]) + calc_faction($lng[1]) / 60 + calc_faction($lng[2]) / 3600;
        $val = "lat: {$lat_value}<br />lng: {$lng_value}<br /><a target='_blank' href='http://maps.google.com/maps?q={$exif['GPSLatitudeRef']}$lat_value,+{$exif['GPSLongitudeRef']}$lng_value&spn=0.0,0.0&t=h&hl=en'>Map</a>";

        return $val;
        break;
    }
  }

  function calc_faction($val)
  {
    $unit = "秒";
    $arr = explode("/",$val);
    if(count($arr) != 2)
      return $val;
    $arr[0] = intval($arr[0]);
    $arr[1] = intval($arr[1]);
    if($arr[1] !=0)
    {
      return $arr[0] / $arr[1];
    }
    else
      return 0;
  }
?>
<? if(isset($exif[Make])): ?>
<ul style="display:block">
  <li class="exif-item"><label>項目</label><span>資訊</span></li>
  <?$i=0;foreach($supported_exif as $key => $value):if(!isset($exif[$key]))continue; $i++?>
  <li class="exif-info">
    <label><?=$value?></label>
    <span>
        <?
          if($replace_array[$key])
          {
            echo $replace_array[$key][$exif[$key]];
          }
          else if(($val = convert($key, $exif)) == -1)
          {
            echo $exif[$key];
          }
          else
          {
            echo $val;
          }
        ?>
    </span>
  </li>
  <?endforeach?>
</ul>
<? else: ?>
<table id="et" align=center>
  <tr>
    <td><?=$lang_no_exif?></td>
  </tr>
</table>
<?endif?>
