<?php
class Api extends Controller {
    var $base_path = "/home/www/develop/lab/thumb/album/tiger/";
    var $up_path = "/home/www/develop/lab/thumb/.thumbs/";

    function __construct()
    {
        parent::Controller();
    }

    function getVersion()
    {
        $time_stamp = $this->input->get("t");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $callback = $this->input->get("callback");
        $sig = $this->input->get("sig");
        $info_arr['errno'] = "";
        $info_arr['version'] = "0.1.7";
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function getRouter()
    {
        $callback = $this->input->get("callback");
        $time_stamp = $this->input->get("t");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $sig = $this->input->get("sig");
        $info_arr['status'] = "ok";
        $info_arr['errno'] = "";
        $info_arr['errmsg'] = "";
        $info_arr['router']['vid'] = "venderID";
        $info_arr['router']['pid'] = "productID";
        $info_arr['router']['sn'] = "serialnumber";
        $info_arr['router']['mac'] = "00:13:46:3D:F8:AF";
        $info_arr['router']['model'] = "DIR615";
        $info_arr['router']['ws_ip'] = "192.168.0.1";
        $info_arr['router']['ws_port'] = "81";
        $info_arr['router']['external_ip'] = "213.34.45.23";
        $info_arr['router']['external_port'] = "5555";
        $info_arr['user_mac'] = "00:26:5E:E9:5A:2E";
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
        $callback = $this->input->get("callback");
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
        echo "{$callback}({$ary})";
    }

    function getDirectoryFiles($path, $sortby = "name", $sign = "+")
    {
        $path = rtrim($path, "/")."/";
        $this->load->helper("directory");
        $this->load->helper("file");
        $dir_ary = directory_map($path, TRUE);
        $file_attr_arr = array('base64_name', 'name', 'size', 'date', 'mtime', 'is_dir', 'type', 'md5');
        $files_arr = array();
        foreach ($dir_ary as $file)
        {
            $tmp_arr = get_file_info($path.$file, $file_attr_arr);
            $addmd5 = ($sortby == "type") ? "_{$tmp_arr['md5']}" : "";
            $files_arr[$tmp_arr[$sortby].$addmd5] = get_file_info($path.$file, $file_attr_arr);
        }

        if ($sign == "-")
        {
            krsort($files_arr);
        }
        else
        {
            ksort($files_arr);
        }

        foreach ($files_arr as $f_arr)
        {
            $ordered_arr[] = $f_arr;
        }

        return $ordered_arr;
    }

    function getFileList()
    {
        $time_stamp = $this->input->get("t");
        $callback = $this->input->get("callback");
        $expire = $this->input->get("expires");
        $routerKeyid = $this->input->get("routerAccessKeyId");
        $sig = $this->input->get("sig");
        $dir_path = $this->base_path.$this->input->get("path");
        $pgoffset = $this->base_path.$this->input->get("pageoffset");
        $maxcount = $this->base_path.$this->input->get("maxcount");
        $sortby = $this->input->get("sortby");
        if (empty($sortby))
        {
            $sign = "+"; 
            $sort = "name";
        }
        else
        {
            $sign = substr($sortby, 0, 1);
            $sort = substr($sortby, 1, 4);
        }
        $files_arr = $this->getDirectoryFiles($dir_path, $sort, $sign);
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['status'] = "ok";
        $info_arr['count'] = count($files_arr);
        $info_arr['files'] = $files_arr;
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo ($callback) ? "{$callback}({$ary})" : $ary;
    }

    function createDirectory()
    {
        $path = $this->base_path.$this->input->get("path");
        $dirname = $path.$this->input->get("dirname");
        $callback = $this->input->get("callback");
        if (mkdir($dirname, 0700))
        //if (1)
        {
            $files_arr = $this->getDirectoryFiles($path, "name");
            $info_arr = array();
            $info_arr['errno'] = "";
            $info_arr['files'] = $files_arr;
            $ary = json_encode($info_arr);
            header("Cache-Control: no-cache");
            header("Content-Type: application/json");
            echo "{$callback}({$ary})";
        }
        else
        {
            echo 0;
        }
    }

    function uploadFile()
    {
        $thumbing = $this->input->post("thumbing");
        $path = ( ! empty($thumbing)) ? $this->up_path : $this->base_path.$this->input->post("path");
        $config['upload_path'] = $path;
        $config['allowed_types'] = "jpg|gif|png";
        $this->load->library("upload", $config);
        $this->upload->do_upload("Filedata");
        $data = $this->upload->data();
        $callback = $this->input->post("callback");
        $status = ( ! count($this->upload->error_msg)) ? "ok" : "fail";
        $info_arr = array();
        $info_arr['status'] = $status;
        $info_arr['errno'] = "";
        $info_arr['errmsg'] = $this->upload->error_msg;
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        //header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function deleteFiles()
    {
        $path = $this->base_path.$this->input->post("path");
        $file_arr = $this->input->post("files");
        $callback = $this->input->post("callback");
        $status = array(1, 0, 1, 1);
        foreach($file_arr as $k => $df)
        {
            $df_arr[$k]['name'] = $df;
            $df_arr[$k]['status'] = $status[$k];
        }
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['files'] = $df_arr; 
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function renameFile()
    {
        $source_file = $this->input->post("src_fullfilename");
        $target_file = $this->input->post("dst_filename");
        $callback = $this->input->post("callback");
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['errmsg'] = "";
        $info_arr['status'] = "ok";
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function copyFilesTo()
    {
        $src_path = $this->base_path.$this->input->post("src_path");
        $dst_path = $this->base_path.$this->input->post("dst_path");
        $file_arr = $this->input->post("files");
        $callback = $this->input->post("callback");
        $status = array(1, 0, 1, 1);
        foreach($file_arr as $k => $f)
        {
            $f_arr[$k]['name'] = $f;
            $f_arr[$k]['status'] = $status[$k];
        }
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['files'] = $f_arr; 
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function moveFilesTo()
    {
        $src_path = $this->base_path.$this->input->post("src_path");
        $dst_path = $this->base_path.$this->input->post("dst_path");
        $file_arr = $this->input->post("files");
        $callback = $this->input->post("callback");
        $status = array(1, 0, 1, 1);
        foreach($file_arr as $k => $f)
        {
            $f_arr[$k]['name'] = $f;
            $f_arr[$k]['status'] = $status[$k];
        }
        $info_arr = array();
        $info_arr['errno'] = "";
        $info_arr['files'] = $f_arr; 
        $ary = json_encode($info_arr);
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");
        echo "{$callback}({$ary})";
    }

    function downloadFile()
    {
        //var $base_path = "/home/www/develop/lab/thumb/album/tiger/";
        //$mime = $this->input->get("mime");
        $file = $this->input->get("fullfilename");
        $path_file = $this->base_path.$file;
        if (file_exists($path_file))
        {
            /*
            if ($mime != "null")
            {
                header("Content-Type: {$mime}");
            }
            else
            {
                header("Content-Type: application/force-download");
            }
             */
            header("Content-Disposition: attachment; filename=".basename($path_file));
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($path_file));
            return readfile($path_file);
        }
    }
}
?>
