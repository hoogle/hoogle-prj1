<?
  session_start();
  require LIBRARY_PATH."mysql_cfg.inc";
  //require LIBRARY_PATH."function.inc";

  Connect_Mysql();
  $sql = "SELECT m.*, p.book, p.title, p.description FROM web3.map_point m, web3.photo p ";
  $sql.= "WHERE m.userid = '{$_SESSION['userid']}' AND m.id = p.point_id AND ";
  $sql.= "m.lat between '{$_GET['miny']}' AND '{$_GET['maxy']}' AND ";
  $sql.= "m.lng between '{$_GET['minx']}' AND '{$_GET['maxx']}'";
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
