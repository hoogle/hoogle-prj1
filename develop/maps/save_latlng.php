<?
  session_start();
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";

  Connect_Mysql();
  $_POST['now_time'] = date("Y-m-d H:i:s");
  if (isset($_POST['action']))
  {
    Connect_Mysql();
    switch($_POST['action'])
    {
      case "create":
        $sql = "INSERT INTO web3.map_point (userid, lat, lng) ";
        $sql.= "VALUES ('{$_SESSION['userid']}', '{$_POST['lat']}', '{$_POST['lng']}')";
        Query_Mysql($sql);
        $new_markerid = mysql_insert_id();
        Close_Mysql();
        echo "{new_markerid:{$new_markerid}}";
        break;
      case "update":
        $sql = "UPDATE web3.map_point SET ";
        $sql.= "lat = '{$_POST['lat']}', lng = '{$_POST['lng']}', now_time = now() ";
        $sql.= "WHERE id = '{$_POST['point_id']}'";
        Query_Mysql($sql);
        Close_Mysql();
        break;
    }
  }
?>
