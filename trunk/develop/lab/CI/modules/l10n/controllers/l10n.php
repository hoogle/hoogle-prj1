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
        $lang_perm = $this->session->userdata('lang_perm');
        $userid = $this->session->userdata('user_id');
        $is_login = ($userid) ? 1 : 0;
        $data = array(
            'userid' => $userid,
            'is_login' => $is_login,
            'lang_perm' => ($is_login) ? $lang_perm: NULL,
            'use_lang' => $this->_browser_lang,
        );
        $this->load->library("layout", "layout_main");
        if ( ! $is_login)
        {
            $this->layout->view("l10n/index", $data);
        }
        else
        {
            echo modules::run("lang/changes", $data);
        }
    }

    function permission()
    {
        $this->load->library('session');
        $lang_perm = $this->session->userdata('lang_perm');
        $userid = $this->session->userdata('user_id');
        $is_login = ($userid) ? 1 : 0;
        $this->load->library("layout", "layout_main");
        if ( ! $is_login)
        {
            $data = array(
                "lang_perm" => NULL,
                "go_url" => ",l10n,permission",
            );
            $this->layout->view("login/please_login", $data);
        }
        else
        {
            if ( ! require_once(APPPATH.'config/languages.php'))
            {
                return FALSE;
            }
            $data = array(
                "use_lang" => $this->_browser_lang,
                "userid" => $userid,
                "lang_perm" => $lang_perm,
                "lang_arr" => $lang_arr,
            );
            $this->layout->view("l10n/permission", $data);
        }
    }
}
