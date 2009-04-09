<?
  session_start();
  require LIBRARY_PATH."mysql_cfg.inc";
  //require LIBRARY_PATH."function.inc";

  Connect_Mysql();
  $sql = "SELECT * FROM web3.map_point WHERE userid = '{$_SESSION['userid']}' AND lat between '{$_GET['miny']}' AND '{$_GET['maxy']}' AND lng between '{$_GET['minx']}' AND '{$_GET['maxx']}'";
  $res = Query_Mysql($sql);
  $latlngAry = array();
  while($tmp = mysql_fetch_assoc($res))
  {
    $latlngAry[] = $tmp;
  }
  Close_Mysql();
  header("Content-Type: application/json");
  echo json_encode($latlngAry);
?>
