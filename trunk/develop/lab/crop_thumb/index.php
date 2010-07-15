<?php
    define ('THUMBNAIL_CROP_EDGE', 100);
    define ('THUMBNAIL_CROP_COVER', 180);

    function create_thumb($source_file, $thumb_file, $edge = THUMBNAIL_CROP_EDGE, &$src_w=NULL, &$src_h=NULL)
    {
        $composite_img = new Imagick($source_file);
        $blank_img = new Imagick();
        $src_w = $composite_img->getImageWidth();
        $src_h = $composite_img->getImageHeight();

        if ($src_h > $edge && $src_w > $edge)
        {
            $composite_img->cropThumbnailImage($edge, $edge);
            $composite_img->setImageFormat('jpeg');
            $composite_img->writeImage($thumb_file);
            $composite_img->clear();
            $blank_img = $composite_img;
        }
        else
        {
            $blank_img->newImage($edge, $edge, new ImagickPixel('#DEF'), "jpg");
            if ($src_w > $src_h)
            {
                $crop_x = ($src_w/2 - $edge/2);
                $crop_y = 0;
                $offset_x = 0;
                $offset_y = ($edge/2)-($src_h/2);
            }
            else
            {
                $crop_x = 0;
                $crop_y = ($src_h/2 - $edge/2);
                $offset_x = ($edge/2)-($src_w/2);
                $offset_y = 0;
            }

            $composite_img->cropImage($edge, $edge, $crop_x, $crop_y);
            $blank_img->compositeImage($composite_img, Imagick::COMPOSITE_OVER, $offset_x, $offset_y);
            $blank_img->setImageFormat('jpeg');
            $blank_img->writeImage($thumb_file);
            $blank_img->clear();
        }
        return $blank_img;
    }

    //http://122.116.58.213/lab/crop_thumb/?file=fruit
    //file: 1279166339 logo_muchiii Whatsup fruit 
    $file = $_GET['file'];
    $source_file = "/home/www/develop/lab/crop_thumb/{$file}.jpg";
    $thumb_file = "/home/www/develop/lab/crop_thumb/thumb/thumb-{$file}.jpg";
    create_thumb($source_file, $thumb_file, THUMBNAIL_CROP_EDGE, $w, $h);
    if ($w > $h)
    {
        $max_edge = $w;
        $offsetx = $w/2 - THUMBNAIL_CROP_EDGE/2;
        $offsety = ($max_edge/2) - ($h/2);
        $moffsety = ($max_edge/2) - (THUMBNAIL_CROP_EDGE/2);
        $ol = 0;
    }
    else
    {
        $max_edge = $h;
        $offsety = 0;
        $offsetx = ($max_edge/2) - (THUMBNAIL_CROP_EDGE/2);
        $moffsety = ($max_edge/2) - (THUMBNAIL_CROP_EDGE/2);
        $ol = ($max_edge/2) - ($w/2);
    }
?>
<div style="margin:30px 200px;width:1000px;height:700px;background-color:#ccc;">
    <div style="float:left;width:<?php echo $max_edge; ?>px;height:<?php echo $max_edge; ?>px;border:1px solid gray;">
        <div style="padding-top:<?php echo $offsety; ?>px;padding-left:<?php echo $ol; ?>px;">
            <img src="http://devm1.corp.muchiii.com/~richard_wang/<?php echo $file; ?>.jpg">
        </div>
    </div>
    <div style="float:left;">
        <div style="padding-top:<?php echo $moffsety; ?>px;">
            <img src="http://devm1.corp.muchiii.com/~richard_wang/thumb/thumb-<?php echo $file; ?>.jpg">
        </div>
    </div>
    <div style="clear:both;"></div>
    <div style="background-color:#CCC;margin-left:<?php echo $offsetx; ?>px;width:100px;height:100px;border:1px solid yellow;">
            <img src="http://devm1.corp.muchiii.com/~richard_wang/thumb/thumb-<?php echo $file; ?>.jpg">
    </div>
</div>
