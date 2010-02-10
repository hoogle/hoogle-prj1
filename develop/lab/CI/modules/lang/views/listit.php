<?php
$listary = array();
foreach($list as $k => $ary)
{
    $listary[$k]['s_id'] = $ary['s_id'];
    $listary[$k]['key_word'] = $ary['key_word'];
    $listary[$k]['translate'] = $ary['translate'];
    $listary[$k]['status'] = $ary['status'];
}
$ary = json_encode($listary);
//header("Content-Type: application/json");
echo "{\"recordsReturned\":".($k+1).",\"totalRecords\":".($k+1).",\"startIndex\":0,\"sort\":\"userid\",\"dir\":\"asc\",\"pageSize\":10,\"records\":{$ary}}";
?>
