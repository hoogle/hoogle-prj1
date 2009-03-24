<?
  session_start();
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";

  Connect_Mysql();
  //$lalnAry = getListData('web3.map_point', $total, array("userid" => $_SESSION['userid']), "curr_time", "desc"); 
  $sql = "SELECT * FROM web3.map_point WHERE userid = '{$_SESSION['userid']}' AND lat between '{$_GET['miny']}' AND '{$_GET['maxy']}' AND lng between '{$_GET['minx']}' AND '{$_GET['maxx']}'";
  $res = Query_Mysql($sql);
  while($lalnAry[] = mysql_fetch_assoc($res));
  Close_Mysql();
  header("Content-Type: application/json");
  echo json_encode($lalnAry);
?>
