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
        $is_login = ($userid) ? 1 : 0;
        $data = array(
            'userid' => $userid,
            'is_login' => $is_login,
            'lang_arr' => ($is_login) ? $lang_arr : NULL,
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
}
