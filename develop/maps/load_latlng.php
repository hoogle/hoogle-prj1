<?
  session_start();
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";

  Connect_Mysql();
  $lalnAry = getListData('web3.map_latlng', $total, array("userid" => $_SESSION['userid']), "userid"); 
  Close_Mysql();
  header("Content-Type: application/json");
  echo json_encode($lalnAry);
?>
