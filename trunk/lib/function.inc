<?php
  function getUserPath($userid)
  {
    $u = $userid[0];
    if (!is_dir(SYS_UPLOAD_PATH."{$u}/")) mkdir(SYS_UPLOAD_PATH."{$u}/");
    if (!is_dir(SYS_UPLOAD_PATH."{$u}/{$userid}/")) mkdir(SYS_UPLOAD_PATH."{$u}/{$userid}/");
    return SYS_UPLOAD_PATH."{$u}/{$userid}/";
  }

  function initAlbum($userid)
  {
    $book = 1;
    $dataAry = array("userid" => $userid, "title" => "未命名相簿",
                      "update_time" => date("Y-m-d H:i:s"), "book" => 1);
    insertData("web3.album", $dataAry, $album_id);
    if (!is_dir(getUserPath($userid)."{$book}/")) mkdir(getUserPath($userid)."{$book}/");
    return $book;
  }

  function getListData($tablename, &$cnt, $condAry=null, $order_field=null, $desc_str=null, $page=null, $limit=null)
  {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $tablename ";
    if (is_array($condAry))
    {
      $sql.= "WHERE ";
      foreach($condAry as $key => $val)
      {
        if (strcmp($key, "submit") && ($val !== "")) $sql.= "$key = '".$val."' AND ";
      }
      $sql.= "1 ";
    }
    if (!empty($order_field)) {
      $order_str = "ORDER BY $order_field $desc_str ";
      $sql.= $order_str;
    }
    if (!empty($page)) {
      $display_rows = 25;
      $start_row = ($page-1)*$display_rows;
      $sql.= " LIMIT $start_row, $display_rows";
    }
    if (!empty($limit)) {
      $sql.= " LIMIT $limit";
    }
    //echo $sql;
    $result = Query_Mysql($sql);
    $res = Query_Mysql("SELECT found_rows()");
    list($cnt) = mysql_fetch_row($res);
    while($res_ary[] = mysql_fetch_assoc($result));
    mysql_free_result($result);
    foreach ($res_ary as $idx => $val) if (empty($val)) unset($res_ary[$idx]);
    return $res_ary;
  }

  function updateData($tablename, $post_fields, $condAry)
  {
    $sql = "UPDATE $tablename SET ";
    $field_ary = getFields($tablename);

    foreach ($field_ary as $key => $val)
    {
      $sql.= "$val = '".$post_fields[$val]."', ";
    }
    $sql = substr($sql, 0, strlen($sql)-2);
    $sql.= " WHERE ";
    foreach($condAry as $key => $val)
    {
      if (strcmp($key, "submit") && ($val !== "")) $sql.= "$key = '".$val."' AND ";
    }
    $sql.= "1 ";
    //echo "$sql<br />";
    Query_Mysql($sql);
  }

  function insertData($tablename, $post_fields, &$newid)
  {
    $sql = "INSERT INTO $tablename (";
    $field_ary = getFields($tablename);
    foreach ($field_ary as $val)
    {
      $sql.= "$val, ";
    }
    $sql = substr($sql, 0, strlen($sql)-2);
    $sql.= ") VALUES (";
    foreach ($field_ary as $key => $val)
    {
      $sql.= "'".$post_fields[$val]."', ";
    }
    $sql = substr($sql, 0, strlen($sql)-2).")";
    //echo "$sql<br />";
    Query_Mysql($sql);
    $newid = mysql_insert_id();
  }

  function getFields($tablename)
  {
    $sql = "SHOW COLUMNS FROM $tablename";
    $res = Query_Mysql($sql) or die("get fields from activities error!");
    $fields_ary = array();
    for($i=0; $i<mysql_num_rows($res); $i++)
    {
      $fields_ary[] = mysql_result($res, $i);
    }
    return $fields_ary;
  }

  function getUserIP()
  {
    if (getenv("HTTP_CLIENT_IP")) { 
      $user_ip = getenv("HTTP_CLIENT_IP"); 
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) { 
      $user_ip = getenv("HTTP_X_FORWARDED_FOR"); 
    } else { 
      $user_ip = getenv("REMOTE_ADDR"); 
    }
    return $user_ip;
  }
?>
