<?php
$tile_str = $_SERVER['QUERY_STRING'];
$para_ary = split(",", $tile_str);
$para_length = count($para_ary);

function tile_offset($t)
{
  return $t*(ICON_SIZE+2)+1;
}

// Create new image to contain appended imgs
$img = new Imagick();
$img->newImage(ICON_SIZE+2, tile_offset($para_length), new ImagickPixel('white'));
$img->setImageFormat('jpeg');

// Append images on new image
if ($tile_str)
{
  $image_ary = array();
  foreach($para_ary as $k => $para)
  {
    if (!intval($para)) continue;
    $tile_file = TILE_UPLOAD_PATH."t{$para}.jpg";
    if (file_exists($tile_file))
    {
      $image_ary[$k] = new Imagick($tile_file);
    }
    else
    {
      $draw = new ImagickDraw();
      $draw->setFontSize(9);
      $image_ary[$k] = new Imagick();
      $image_ary[$k]->newImage(ICON_SIZE, ICON_SIZE, new ImagickPixel('#bbddff'), "jpeg");
      $image_ary[$k]->annotateImage($draw, 2, 10, 0, "PIC\nNOT\nEXIST");
      $image_ary[$k]->drawImage($draw);
    }
    $img->compositeImage($image_ary[$k], Imagick::COMPOSITE_OVER, 1, tile_offset($k));
  }
}

header('Content-type: image/jpeg');
echo $img;
?>
