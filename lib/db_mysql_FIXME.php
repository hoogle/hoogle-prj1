<?php
class Db {
  protected $dbhost = "localhost";
  protected $dbname = DBNAME;
  protected $dbuser = DBUSER;
  protected $dbpwd  = PASSWORD;
  protected $link_id;

  public function __construct($dbHost=null) {
    $this->hostname = $dbHost;
  }

  protected function unsetPrivateData() {
    if (isset($this->dbhost)) unset($this->dbhost);
    if (isset($this->dbname)) unset($this->dbname);
    if (isset($this->dbuser)) unset($this->dbuser);
    if (isset($this->dbpwd))  unset($this->dbpwd);
  }
}

class Mysql extends Db {

  private static $instance;

  public function __construct($dbHost=null) {
    parent::__construct($dbHost);

    if (is_null($this->dbhost))
      die("MySQL hostname not set");
    else if (is_null($this->dbname))
      die("MySQL database not selected");
    else if (is_null($this->dbuser))
      die("MySQL hostname not set");
    else if (is_null($this->dbpwd))
      die("MySQL pwd not currect");

    if (!$this->link_id)
    {
      $this->link_id = mysql_connect($this->hostname, $this->dbuser, $this->dbpwd);
    }
    mysql_query("SET NAMES UTF-8", $this->link_id);

    if ($this->dbname)
    {
      mysql_select_db($this->dbname, $this->link_id);
    }
  }

  public static function getInstance($dbHost) {
    if(!Mysql::$instance) {
      Mysql::$instance = new Mysql($dbHost);
    }
    return Mysql::$instance;
  }

  public function Connected() {
    if (is_resource($this->link_id)) {
      $this->unsetPrivateData();
      return true;
    }
    else
    {
      return false;
    }
  }

  public function AffectedRows() {
    return mysql_affected_rows($this->link_id);
  }

  public function close() {
    mysql_close($this->link_id);
    $this->link_id = null;
  }

  public function query($sql) {
    $this->Connected();
    $result = mysql_query($sql, $this->link_id);
    if ($result === false) {
      die(mysql_error());
    }
    return $result;
  }

  public function fetchAssoc($result) {
    $data = array();
    while($tmp = mysql_fetch_assoc($result))
    {
      $data[] = $tmp;
    }
    return $data;
  }
}
?>
