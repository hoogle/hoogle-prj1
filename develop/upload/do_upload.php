<?
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";
  Connect_Mysql();
  $userid = $_POST['userid'];
  $pid = $_POST['pid'];
  $title = $_POST['title'];
  $desc = $_POST['desc'];

  $userPicAry = getListData("web3.photo", $acnt, array("userid" => $userid));
  if (!$acnt) initAlbum($userid);
  $target_book_path = getUserPath($userid).USER_MAX_BOOKID;
  $target_thumb_path = "{$target_book_path}/thumb";
  $target_org_img = "{$target_book_path}/{$pid}.jpg";
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
    "book" => USER_MAX_BOOKID,
    "title" => $title,
    "description" => $desc,
    "post_time" => "now()",
    "point_id" => $pid
  ); 
  print_r($dataAry);
  insertData("web3.photo", $dataAry, $photo_id); 
?>
