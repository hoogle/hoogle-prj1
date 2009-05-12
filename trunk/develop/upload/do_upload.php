<?
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";
  Connect_Mysql();
  $userid = $_POST['userid'];
  $title = urldecode($_POST['title']);
  $desc = urldecode($_POST['desc']);
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $address = urldecode($_POST['address']);

  $new_point_ary = array(
    "userid" => $userid,
    "lat" => $lat,
    "lng" => $lng,
    "address" => $address,
    "curr_time" => date("Y-m-d H:i:s")
  );
  insertData("web3.map_point", $new_point_ary, $pid); 
  $userPicAry = getListData("web3.photo", $acnt, array("userid" => $userid));
  if (!$acnt) initAlbum($userid);
  $target_set_path = getUserPath($userid).USER_MAX_SETID;
  if (!is_dir($target_set_path)) mkdir($target_set_path);
  $target_thumb_path = "{$target_set_path}/thumb";
  if (!is_dir($target_thumb_path)) mkdir($target_thumb_path);
  $target_org_img = "{$target_set_path}/{$pid}.jpg";
  $target_thumb_img = "{$target_thumb_path}/t{$pid}.jpg";
  $target_tile_img = TILE_UPLOAD_PATH."t{$pid}.jpg";

  foreach ($_FILES as $fieldName => $file)
  { 
    $tmp_file = $file['tmp_name'];
    $file_name = str_replace('..', '', $file['name']); 
    $file_name = str_replace('/', '', $file_name); 

    $cmd = sprintf("/usr/local/bin/convert %s -thumbnail '90x90^' -gravity center -extent 90x90 %s", $tmp_file, $target_thumb_img);
    system($cmd);

    $cmd = sprintf("/usr/local/bin/jpegtopnm %s | /usr/local/bin/pnmscale -width=%d -height=%d | /usr/local/bin/ppmtojpeg > %s", $tmp_file, ICON_SIZE, ICON_SIZE, $target_tile_img);
    system($cmd);

    $cmd = sprintf("/usr/local/bin/convert -resize '%dx%d>' '%s' '%s'", 550, 550, $tmp_file, $target_org_img);
    system($cmd);

    //$cmd = sprintf("/usr/local/bin/jpegtopnm %s | /usr/local/bin/pnmscale -width=%d | /usr/local/bin/ppmtojpeg > %s", $tmp_file, 90, $target_thumb_img);
    //system($cmd);
    //move_uploaded_file($tmp_file, $target_org_img);
  } 
  $dataAry = array(
    "userid" => $userid,
    "set" => USER_MAX_SETID,
    "title" => $title,
    "description" => $desc,
    "post_time" => date("Y-m-d H:i:s"),
    "point_id" => $pid
  ); 
  print_r($dataAry);
  insertData("web3.photo", $dataAry, $photo_id); 
?>
