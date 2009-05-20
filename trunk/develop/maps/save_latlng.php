<?
  session_start();
  require LIBRARY_PATH."function.php";

  $curr_time = date("Y-m-d H:i:s");
  if (isset($_POST['action']))
  {
    $db = Mysql::getInstance('localhost');
    switch($_POST['action'])
    {
      case "create":
        $data_point = array(
          "userid" => $_SESSION['userid'], 
          "lat" => $_POST['lat'], 
          "lng" => $_POST['lng'],
          "curr_time" => $curr_time
        );
        insertData("web3.map_point", $data_point, $new_markerid);
        $data_photo = array(
          "userid" => $_SESSION['userid'], 
          "set" => $set,
          "title" => $title,
          "description" => $desc,
          "post_time" => $curr_time,
          "point_id" => $new_markerid
        );
        insertData("web3.photo", $data_photo, $new_photo);
        $db->close();
        echo "{new_markerid:{$new_markerid}}";
        break;
      case "update":
        $sql = "UPDATE web3.map_point SET ";
        $sql.= "lat = '{$_POST['lat']}', lng = '{$_POST['lng']}', curr_time = '{$curr_time}' ";
        $sql.= "WHERE id = '{$_POST['point_id']}'";
        $db->query($sql);
        $db->close();
        break;
    }
  }
?>
