<?
  session_start();
  require LIBRARY_PATH."db_mysql.php";

  $db = Mysql::getInstance('localhost');
  $sql = "SELECT m.*, p.set, p.title, p.description FROM web3.map_point m, web3.photo p ";
  $sql.= "WHERE m.userid = '{$_SESSION['userid']}' AND m.id = p.point_id AND ";
  $sql.= "m.lat between '{$_GET['miny']}' AND '{$_GET['maxy']}' AND ";
  $sql.= "m.lng between '{$_GET['minx']}' AND '{$_GET['maxx']}'";
  $res = $db->query($sql);
  $latlngAry = array();
  while($tmp = mysql_fetch_assoc($res))
  {
    $latlngAry[] = $tmp;
  }
  $db->close();
  header("Content-Type: application/json");
  echo json_encode($latlngAry);
?>
