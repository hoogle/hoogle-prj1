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

    function getDirectoryFiles($path)
    {
        $this->load->helper("directory");
        $this->load->helper("file");
        $dir_ary = directory_map($path, TRUE);
        $fileattr_arr = array('name', 'size', 'date', 'is_dir');
        foreach ($dir_ary as $file)
        {
            $files_arr[] = get_file_info($path.$file, $fileattr_arr);
        }
        return $files_arr;
    }

    function getFileList()
    {
        $path = $this->base_path.$this->input->get("path");
        $files_arr = $this->getDirectoryFiles($path);
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['count'] = count($files_arr);
        $info_arr['files'] = $files_arr;
        $ary = json_encode($info_arr);
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
            //$files_arr = $this->getDirectoryFiles($path);
            $info_arr = array();
            $info_arr['errno'] = "";
            //$info_arr['files'] = $files_arr;
            $json_ary = json_encode($info_arr);
            header("Cache-Control: no-cache");
            header("Content-Type: application/json");
            echo $json_ary;
        }
        else
        {
            echo 0;
        }
    }

    function uploadFile()
    {
        $path = $this->base_path.$this->input->post("path");
        $browse_file = $this->input->post("browse_file");
        //$files_arr = $this->getDirectoryFiles($path);
        $info_arr = array();
        $info_arr['errno'] = "";
        //$info_arr['files'] = $files_arr;
        $json_ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $json_ary;
    }

    function deleteFiles()
    {
        $path = $this->base_path.$this->input->post("path");
        $file_arr = $this->input->post("del_files");
        $status = array(1, 0, 1, 1);
        foreach($file_arr as $k => $df)
        {
            $df_arr[$k]['name'] = $df;
            $df_arr[$k]['status'] = $status[$k];
        }
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['files'] = $df_arr; 
        $json_ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $json_ary;
    }
}
?>
