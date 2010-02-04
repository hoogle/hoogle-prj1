<?
switch($_POST['func']) {
  case "save_wish_loc":
    $data = json_decode(stripslashes($_POST['data']), true);
    print_r($data);
    break;
}
?>
