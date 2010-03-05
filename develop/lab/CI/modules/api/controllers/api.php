<?php
class Api extends Controller {
    var $base_path = "/tmp/ci/";

    function __construct()
    {
        parent::Controller();
    }

    function index()
    {
    }

    function getFileList()
    {
        $path = $this->base_path.$this->input->get("path");
        $this->load->helper("file");
        $folder_arr = get_dir_file_info($path);
        $json_arr = array();
        $json_arr['errno'] = "";
        $json_arr['count'] = count($folder_arr);
        $json_arr['files'] = $folder_arr;
        $ary = json_encode($json_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $ary;
    }

    function createDirectory()
    {
        $path = $this->base_path.$this->input->get("path");
        $dirname = $path.$this->input->get("dirname");
        //if (mkdir($dirname, 0700))
        if (1)
        {
            $this->load->helper("directory");
            $this->load->helper("file");
            $ary = directory_map($path, TRUE);
            $fileattr_arr = array('name', 'size', 'date', 'is_dir');
            foreach ($ary as $f)
            {
                $arr[] = get_file_info($path.$f, $fileattr_arr);
            }
            $json_ary = json_encode($arr);
            header("Cache-Control: no-cache");
            header("Content-Type: application/json");
            echo $json_ary;
        }
        else
        {
            echo 0;
        }
    }
}
?>
