<?php
class Login extends Controller {
    private $_browser_lang = "";

    public function __construct()
    {
        parent::Controller();
        $this->load->database();
        $this->load->model("l10n_model");
        $accept_lang_arr = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        list($lang_lang, $lang_country) = explode("-", $accept_lang_arr[0]);
        $this->_browser_lang = (is_null($lang_country)) ? "en_US" : strtolower($lang_lang)."_".strtoupper($lang_country);
    }

    public function index($go_url = NULL)
    {
        $this->load->library('session');
        $uid = $this->session->userdata('user_id'); 
        $is_login = ($uid) ? 1 : 0;
        $url = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "/l10n/";
        $go_url = ( ! is_null($go_url)) ? "/l10n".str_replace(",", "/", $go_url) : $url;
        $data = array(
            'userid' => $uid,
            'is_login' => $is_login,
            'go_url' => $go_url,
        );
        $this->load->view('l10n/login/login', $data);
    }

    public function logout()
    {
        $this->load->library('session');
        $this->session->unset_userdata('user_id'); 
        $this->session->unset_userdata('lang_perm'); 
        header("location:/l10n/");
        exit;
    }

    public function get_bit_array($dec)
    {
        $n = 1 ;
        while ($dec > 0)
        {
            if ($dec & 1 == 1)
            {
                $bit_arr[] = $n;
            }
            $n *= 2 ;
            $dec >>= 1 ;
        }
        return $bit_arr;
    }

    public function get_lang_perm($perm)
    {
        $bit_arr = $this->get_bit_array($perm);
        $lang_ary = $this->l10n_model->get_languages(implode(", ", $bit_arr));
        return $lang_ary;
    }

    public function check()
    {
        $uid = $this->input->post('userid');
        $pwd = $this->input->post('passwd');
        $uary = $this->l10n_model->get_userdata($uid);
        if ($uary['pass_word'] == MD5($pwd))
        {
            $uary['pass_word'] = "";
            $uary['use_lang'] = $this->_browser_lang;
            $uary['lang_perm'] = $this->get_lang_perm($uary['permission']);
            $this->load->library('session');
            $this->session->set_userdata($uary);
            $this->l10n_model->set_user_stat($uid);
            $go_url = $this->input->post('go_url');
            header("location:{$go_url}");
            exit;
        }
        else
        {
            echo "ID/PWD error!!!";
        }
    }
}
?>
