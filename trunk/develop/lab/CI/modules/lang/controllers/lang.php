<?php
class Lang extends Controller {

    function __construct()
    {
        parent::Controller();
    }

    function get_uselang($lang = NULL)
    {
        if ( ! is_null($lang))
        {
            $this->_browser_lang = $lang;
        }
        else
        {
            $accept_lang_arr = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
            list($lang_lang, $lang_country) = explode("-", $accept_lang_arr[0]);
            $this->_browser_lang = (is_null($lang_country)) ? "en_US" : strtolower($lang_lang)."_".strtoupper($lang_country);
        }
    }

    function index()
    {
        $this->get_uselang();
        $this->load->database();
        $this->load->model("l10n_model");
        $this->load->library("session");
        $params = array (
            "use_lang" => $this->_browser_lang,
        );
        $data = array (
            "lang_arr" => $this->session->userdata("lang_perm"),
            "userid" => $this->session->userdata("user_id"),
            "use_lang" => $this->_browser_lang,
            "list" => $this->l10n_model->get_all_lang($params, $total),
        );
        $this->load->library("layout", "layout_main");
        $this->layout->view("lang/show", $data);
    }

    function changes()
    {
        $lang = $this->_browser_lang;
        $this->load->library("session");
        $userid = $this->session->userdata("user_id");
        $lang_arr = $this->session->userdata("lang_perm");
        if ($userid === FALSE)
        {
            $data = array(
                "userid" => NULL,
                "go_url" => ",lang,changes",
                "lang_arr" => NULL 
            );
            $this->load->library("layout", "layout_main");
            $this->layout->view("login/please_login", $data);
        }
        else
        {
            $this->load->database();
            $this->load->model("l10n_model");

            foreach ($lang_arr as $lang_item)
            {
                $trans_arr = $this->l10n_model->get_retranslated($lang_item["l_type"]);
                foreach ($trans_arr as $k => $arr)
                {
                    $rec[$lang_item["l_type"]][$k]["key_word"] = $trans_arr[$k]["key_word"];
                    $rec[$lang_item["l_type"]][$k]["translate"] = $trans_arr[$k]["translate"];
                }
            }
            $data = array(
                "rec" => $rec,
                "use_lang" => $lang,
                "userid" => $userid,
                "lang_arr" => $lang_arr,
            );
            $this->load->library("layout", "layout_main");
            $this->layout->view("lang/changes", $data);
        }
    }

    function edit($sid)
    {
        $this->load->library("session");
        $userid = $this->session->userdata("user_id");
        $lang_arr = $this->session->userdata("lang_perm");
        $this->load->library("layout", "layout_main");
        if ($userid === FALSE)
        {
            $data = array(
                "userid" => NULL,
                "lang_arr" => NULL,
                "go_url" => ",lang,edit,{$sid}",
            );
            $this->layout->view("login/please_login", $data);
        }
        else
        {
            $this->load->database();
            $this->load->model("l10n_model");
            foreach ($lang_arr as $lang_item)
            {
                $params = array (
                    "lang" => $lang_item["l_type"],
                    "sid" => $sid,
                );
                $trans_arr = $this->l10n_model->get_all_lang($params, $total);
                $langs[$lang_item["l_type"]]["translate"] = $trans_arr[0]["translate"];
                $langs[$lang_item["l_type"]]["original"] = $trans_arr[0]["original"];
            }
            $langs["key_word"] = $trans_arr[0]["key_word"];
            $data = array(
                "userid" => $userid,
                "use_lang" => $this->_browser_lang,
                "lang_arr" => $lang_arr,
                "list" => $langs,
                "sid" => $sid,
                "div" => "edit",
            );
            $this->layout->view("lang/edit", $data);
        }
    }

    function update()
    {
        $this->load->library("session");
        $userid = $this->session->userdata("user_id");
        echo $userid;

        $this->load->database();
        $this->load->model("l10n_model");

        $sid = $this->input->post("s_id");
        $translate = $this->input->post("translate");
        $l_type = $this->session->userdata("use_lang");

        $data = array(
            "translate" => $translate,
            "sid" => $sid,
            "l_type" => $l_type,
            "userid" => $userid,
        );
        $this->l10n_model->edit_lang($data);
    }

    function upd($sid)
    {
        $this->load->library("session");
        $userid = $this->session->userdata("user_id");
        if ($userid === FALSE)
        {
            $needlogin_view = $this->load->view("login/please_login", array("go_url" => ",lang,list_all"), TRUE);
            echo $needlogin_view;
            exit;
        }
        $userid = $this->session->userdata("user_id");
        $lang_arr = $this->session->userdata("lang_perm");

        $this->load->database();
        $this->load->model("l10n_model");
        foreach ($lang_arr as $lang_item)
        {
            $l_type = $lang_item["l_type"];
            $data = array(
                "key_word"  => $this->input->post("key_word"),
                "translate"  => $this->input->post("{$l_type}_word"),
                "sid" => $sid,
                "l_type" => $l_type,
                "userid" => $userid,
            );
            $this->l10n_model->edit_lang($data);
        }
        header("location:/lang/list_all");
        exit;
    }

    function add()
    {
        $this->load->library("session");
        $lang_arr = $this->session->userdata("lang_perm");

        $data = array(
            "userid" => $this->session->userdata("user_id"),
            "use_lang" => $this->session->userdata("use_lang"),
            "lang_arr" => $lang_arr,
        );
        $this->load->library("layout", "layout_main");
        $view_page = ($lang_arr) ? "lang/add" : "login/please_login";
        $this->layout->view($view_page, $data);
    }

    function ins()
    {
        $this->load->database();
        $this->load->model("l10n_model");
        $this->load->library("session");
        $lang_arr = $this->session->userdata("lang_perm");
        foreach ($lang_arr as $lang_item)
        {
            $l_type = $lang_item["l_type"];
            $langs[$l_type] = $this->input->post("{$l_type}_word");
        }
        $data = array(
            "key_word"  => $this->input->post("key_word"),
            "langs"  => $langs,
        );
        $this->l10n_model->add_newlang($data);
        header("location:/lang/list_all");
        exit;
    }

    function list_all($lang = NULL)
    {
        $this->get_uselang($lang);
        $this->load->library("session");
        $userid = $this->session->userdata("user_id");
        if ( ! is_null($lang)) {
            $this->_browser_lang = $lang;
            $this->session->set_userdata(array("use_lang" => $this->_browser_lang));
        }
        $this->load->library("layout", "layout_main");
        if ($userid === FALSE)
        {
            $data = array(
                "userid" => NULL,
                "lang_arr" => NULL,
                "go_url" => ",lang,list_all",
            );
            $this->layout->view("login/please_login", $data);
        }
        else
        {
            $data = array(
                "userid" => $userid,
                "lang_arr" => $this->session->userdata("lang_perm"),
                "use_lang" => $this->_browser_lang,
            );
            $this->layout->view("lang/show", $data);
        }
    }

    function listit($lang = NULL)
    {
        $this->get_uselang($lang);
        $sort = $this->input->get("sort");
        $dir = $this->input->get("dir");
        $start = $this->input->get("startIndex");
        $results = $this->input->get("results");
        $this->load->database();
        $this->load->model("l10n_model");
        $this->load->library("session");
        $params = array (
            "use_lang" => $this->session->userdata("use_lang"),
            "sort" => $sort,
            "dir" => $dir,
            "start" => $start,
            "results" => $results,
        );
        $data = array (
            "list" => $this->l10n_model->get_all_lang($params, $total),
            "total" => $total,
        );
        $this->load->view("lang/listit", $data);
    }

    function build($lang=null)
    {
        $this->load->library("session");
        $userid = $this->session->userdata("user_id");
        $this->load->database();
        $this->load->model("l10n_model");
        $lang_arr = $this->session->userdata("lang_perm");

        if ($userid === FALSE)
        {
            $data = array(
                "userid" => NULL,
                "lang_arr" => NULL,
                "go_url" => ",lang,build",
            );
            $this->load->library("layout", "layout_main");
            $this->layout->view("login/please_login", $data);
        }
        else
        {
            foreach ($lang_arr as $lang_item)
            {
                $params = array (
                    "use_lang" => $lang_item["l_type"],
                    "sort" => "",
                    "dir" => "",
                    "start" => "",
                    "results" => "",
                );
                $arr = $this->l10n_model->get_all_lang($params, $total);
                $gen_str = "<?php\n";
                foreach ($arr as $ary)
                {
                    $gen_str.= "\$lang['l10n_{$ary["key_word"]}'] = \"{$ary['translate']}\";\n"; 
                }
                $gen_str.= "?>\n";
                $filepath = APPPATH."language/{$lang_item["l_type"]}/l10n_lang.php";
                $fh = fopen($filepath, "w+");
                fwrite($fh, $gen_str);
                fclose($fh);
            }
            header("location:/lang/list_all");
            exit;
        }
    }
}
?>
