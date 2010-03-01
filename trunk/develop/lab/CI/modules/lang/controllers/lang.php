<?php
class Lang extends Controller {
    function __construct()
    {
        parent::Controller();
        $accept_lang_arr = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        list($lang_lang, $lang_country) = explode("-", $accept_lang_arr[0]);
        $this->_browser_lang = (is_null($lang_country)) ? "en_US" : strtolower($lang_lang)."_".strtoupper($lang_country);
    }

    function index()
    {
        $this->load->database();
        $this->load->model("l10n_model");
        $this->load->library('session');
        $params = array (
            'lang' => $this->_browser_lang,
        );
        $data = array (
            'lang_arr' => NULL,
            'userid' => $this->session->userdata('user_id'),
            'list' => $this->l10n_model->get_all_lang($params, $total),
        );
        $this->load->library("layout", "layout_main");
        $this->layout->view("lang/show", $data);
    }

    function changes()
    {
        $lang = $this->_browser_lang;
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');
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
                $trans_arr = $this->l10n_model->get_retranslated($lang_item['l_type']);
                foreach ($trans_arr as $k => $arr)
                {
                    $rec[$lang_item['l_type']][$k]['key_word'] = $trans_arr[$k]['key_word'];
                    $rec[$lang_item['l_type']][$k]['translate'] = $trans_arr[$k]['translate'];
                }
            }
            $data = array(
                'rec' => $rec,
                'use_lang' => $lang,
                'userid' => $userid,
                'lang_arr' => $lang_arr,
            );
            $this->load->library("layout", "layout_main");
            $this->layout->view("lang/changes", $data);
        }
    }

    function edit($sid)
    {
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');
        if ($userid === FALSE)
        {
            $data = array(
                "userid" => NULL,
                "lang_arr" => NULL,
                "go_url" => ",lang,edit,{$sid}",
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
                $params = array (
                    'lang' => $lang_item['l_type'],
                    'sid' => $sid,
                );
                $trans_arr = $this->l10n_model->get_all_lang($params, $total);
                $langs[$lang_item['l_type']]['translate'] = $trans_arr[0]['translate'];
                $langs[$lang_item['l_type']]['original'] = $trans_arr[0]['original'];
            }
            $langs['key_word'] = $trans_arr[0]['key_word'];
            $data = array(
                'userid' => $userid,
                'use_lang' => $this->_browser_lang,
                'lang_arr' => $lang_arr,
                'list' => $langs,
                'sid' => $sid,
                'div' => 'edit',
            );
            $this->load->library("layout", "layout_main");
            $this->layout->view("lang/edit", $data);
        }
    }

    function update()
    {
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        echo $userid;
        if ($userid == FALSE)
        {
            //header("location:/login/".urlencode($_SERVER['REQUEST_URI']));
            exit;
        }

        $this->load->database();
        $this->load->model("l10n_model");

        $sid = $this->input->post('s_id');
        $translate = $this->input->post('translate');
        //$l_type = $this->input->post('l_type');
        $l_type = 'zh_TW';

        $data = array(
            'translate' => $translate,
            'sid' => $sid,
            'l_type' => $l_type,
            'userid' => $userid,
        );
        $this->l10n_model->edit_lang($data);
    }

    function upd($sid)
    {
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        if ($userid === FALSE)
        {
            $needlogin_view = $this->load->view("login/please_login", array("go_url" => ",lang,list_all"), TRUE);
            echo $needlogin_view;
            exit;
        }
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');

        $this->load->database();
        $this->load->model("l10n_model");
        foreach ($lang_arr as $lang_item)
        {
            $l_type = $lang_item['l_type'];
            $data = array(
                'key_word'  => $this->input->post('key_word'),
                'translate'  => $this->input->post("{$l_type}_word"),
                'sid' => $sid,
                'l_type' => $l_type,
                'userid' => $userid,
            );
            $this->l10n_model->edit_lang($data);
        }
        header("location:/lang/list_all");
        exit;
    }

    function add()
    {
        $this->load->library('session');
        $lang_arr = $this->session->userdata('lang_perm');
        $userid = $this->session->userdata('user_id');

        $data = array(
            'userid' => $userid,
            'use_lang' => $this->_browser_lang,
            'lang_arr' => $lang_arr,
            'div' => 'add',
        );
        $this->load->library("layout", "layout_main");
        $this->layout->view("lang/add", $data);
    }

    function ins()
    {
        $this->load->database();
        $this->load->model("l10n_model");
        $this->load->library('session');
        $lang_arr = $this->session->userdata('lang_perm');
        foreach ($lang_arr as $lang_item)
        {
            $l_type = $lang_item['l_type'];
            $langs[$l_type] = $this->input->post("{$l_type}_word");
        }
        $data = array(
            'key_word'  => $this->input->post('key_word'),
            'langs'  => $langs,
        );
        $this->l10n_model->add_newlang($data);
        header("location:/lang/list_all");
        exit;
    }

    function list_all($lang = NULL)
    {
        if ( ! isset($lang))
        {
            $lang = $this->_browser_lang;
        }
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');
        $data = array(
            'userid' => $userid,
            'lang_arr' => $lang_arr,
            'use_lang' => $lang,
        );
        $this->load->library("layout", "layout_main");
        $this->layout->view("lang/show", $data);
    }

    function listit($lang = NULL)
    {
        $sort = $this->input->get('sort');
        $dir = $this->input->get('dir');
        $start = $this->input->get('startIndex');
        $results = $this->input->get('results');
        $this->load->database();
        $this->load->model("l10n_model");
        $params = array (
            'lang' => $this->_browser_lang,
            'sort' => $sort,
            'dir' => $dir,
            'start' => $start,
            'results' => $results,
        );
        $data = array (
            'list' => $this->l10n_model->get_all_lang($params, $total),
            'total' => $total,
        );
        $this->load->view("lang/listit", $data);
    }
}
?>
