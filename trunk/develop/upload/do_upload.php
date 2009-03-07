<?
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";
  Connect_Mysql();
  $userid = $_POST['userid'];

  //print_r($_POST);
  //echo "userid : {$userid}";
  $userPicAry = getListData("web3.album", $acnt, array("userid" => $userid));
  $book = (!$acnt) ? initAlbum($userid) : $_POST['book'];
  foreach ($_FILES as $fieldName => $file)
  { 
    $file_name = str_replace('..', '', $file['name']); 
    $file_name = str_replace('/', '', $file_name); 
    move_uploaded_file($file['tmp_name'], getUserPath($userid)."{$book}/{$file_name}"); 
  } 
?>
