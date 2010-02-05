<?php
class L10n extends Controller {
    private $_browser_lang = "";

    function __construct()
    {
        parent::Controller();
        $accept_lang_arr = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        list($lang_lang, $lang_country) = explode("-", $accept_lang_arr[0]);
        $this->_browser_lang = (is_null($lang_country)) ? "en_US" : strtolower($lang_lang)."_".strtoupper($lang_country);
    }

    function index()
    {
        $this->load->library('session');
        $lang_arr = $this->session->userdata('lang_perm');
        $userid = $this->session->userdata('user_id');
        $data = array(
            'userid' => $userid,
            'lang_arr' => $lang_arr,
            'use_lang' => $this->_browser_lang,
            'div' => 'home', 
        );
        $this->load->view("index", $data);
    }

    function edit($sid)
    {
        $this->load->database();
        $this->load->model("l10n_model");
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');
        foreach ($lang_arr as $lang_item)
        {
            $trans_arr = $this->l10n_model->get_all_lang($lang_item['l_type'], $sid);
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
        $this->load->view("index", $data);
    }

    function upd($sid)
    {
        $this->load->library('session');
        $userid = $this->session->userdata('user_id');
        if ($userid === FALSE)
        {
            $needlogin_view = $this->load->view("login/please_login", array("go_url" => "l10n-list_all"), TRUE);
            echo $needlogin_view;
            exit;
        }
        $lang_arr = $this->session->userdata('lang_perm');
        $this->load->database();
        $this->load->model("l10n_model");
        foreach ($lang_arr as $lang_item)
        {
            $l_type = $lang_item['l_type'];
            $langs[$l_type] = $this->input->post("{$l_type}_word");
        }
        $data = array(
            'key_word'  => $this->input->post('key_word'),
            'langs'  => $langs,
            'sid' => $sid,
        );
        $this->l10n_model->edit_lang($data);
        header("location:/l10n/list_all");
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
        $this->load->view("index", $data);
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
        header("location:/l10n/list_all");
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
            'div' => 'list' 
        );
        $this->load->view("index", $data);
    }
}
