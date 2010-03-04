<?php
class Api extends Controller {
    function __construct()
    {
        parent::Controller();
    }

    function index()
    {
    }

    function getFileList()
    {
        $path = $this->input->get("path");
        $this->load->helper("file");
        $folder_arr = get_filenames($path);
        $json_arr = array();
        $json_arr['errno'] = "";
        $json_arr['count'] = count($folder_arr);
        $json_arr['files'] = $folder_arr;
        $ary = json_encode($json_arr);
//        header("Cache-Control: no-cache");
//        header("Content-Type: application/json");
        echo $ary;
    }
}
?>
