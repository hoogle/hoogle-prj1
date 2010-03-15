<?php
class Api extends Controller {
    var $base_path = "/tmp/ci/";

    function __construct()
    {
        parent::Controller();
    }

    function getVersion()
    {
        $time_stamp = $this->input->get("t");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $sig = $this->input->get("sig");
        $info_arr['errno'] = "";
        $info_arr['version'] = "0.1.7";
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $ary;
    }

    function getRouter()
    {
        $callback = $this->input->get("callback");
        $time_stamp = $this->input->get("t");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $sig = $this->input->get("sig");
        $info_arr['errno'] = "";
        $info_arr['router']['vid'] = "venderID";
        $info_arr['router']['pid'] = "productID";
        $info_arr['router']['sn'] = "serialnumber";
        $info_arr['router']['mac'] = "ROUTER_MAC";
        $info_arr['router']['model'] = "DIR615";
        $info_arr['router']['ws_ip'] = "192.168.0.1";
        $info_arr['router']['ws_port'] = "81";
        $info_arr['router']['external_ip'] = "213.34.45.23";
        $info_arr['router']['external_port'] = "5555";
        $info_arr['user_mac'] = "USER_MAC";
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function listShareDevices()
    {
        $time_stamp = $this->input->get("t");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $sig = $this->input->get("sig");
        $device[0]['mountpoints']['mountpoint'] = "/mnt/a";
        $device[0]['model'] = "USB_MODEL";
        $device[0]['name'] = "USB_NAME";
        $device[0]['storage'] = "8000";
        $device[0]['used_space'] = "2500";
        $info_arr['errno'] = "";
        $info_arr['devices'] = $device;
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $ary;
    }

    function getDirectoryFiles($path)
    {
        $this->load->helper("directory");
        $this->load->helper("file");
        $dir_ary = directory_map($path, TRUE);
        $fileattr_arr = array('name', 'server_path', 'size', 'date', 'is_dir');
        foreach ($dir_ary as $file)
        {
            $files_arr[] = get_file_info($path.$file, $fileattr_arr);
        }
        return $files_arr;
    }

    function getFileList()
    {
        $time_stamp = $this->input->get("t");
        $callback = $this->input->get("callback");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $sig = $this->input->get("sig");
        $path = $this->base_path.$this->input->get("path");
        $pgoffset = $this->base_path.$this->input->get("pageoffset");
        $maxcount = $this->base_path.$this->input->get("maxcount");
        $sortby = $this->base_path.$this->input->get("sortby");
        $sort_arr = array("+name", "-name", "+date", "-date", "+type", "-type", "+size", "-size");
        $files_arr = $this->getDirectoryFiles($path);
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['count'] = count($files_arr);
        $info_arr['files'] = $files_arr;
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
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
        $file_arr = $this->input->post("files");
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

    function renameFile()
    {
        $source_file = $this->input->post("src_fullfilename");
        $target_file = $this->input->post("dst_filename");
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['status'] = "OK";
        $json_ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $json_ary;
    }

    function copyFilesTo()
    {
        $src_path = $this->base_path.$this->input->post("src_path");
        $dst_path = $this->base_path.$this->input->post("dst_path");
        $file_arr = $this->input->post("files");
        $status = array(1, 0, 1, 1);
        foreach($file_arr as $k => $f)
        {
            $f_arr[$k]['name'] = $f;
            $f_arr[$k]['status'] = $status[$k];
        }
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['files'] = $f_arr; 
        $json_ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $json_ary;
    }

    function moveFilesTo()
    {
        $src_path = $this->base_path.$this->input->post("src_path");
        $dst_path = $this->base_path.$this->input->post("dst_path");
        $file_arr = $this->input->post("files");
        $status = array(1, 0, 1, 1);
        foreach($file_arr as $k => $f)
        {
            $f_arr[$k]['name'] = $f;
            $f_arr[$k]['status'] = $status[$k];
        }
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['files'] = $f_arr; 
        $json_ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo $json_ary;
    }
}
?>
