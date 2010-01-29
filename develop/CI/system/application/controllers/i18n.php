<?php
class I18n extends Controller {
    function __construct()
    {
        parent::Controller();
        $this->load->database();
        //$this->load->scaffolding('i18n');
    }

    function index($lang=null)
    {
        $loc_lang = $this->use_lang($lang);
        $res = $this->db->query("SELECT key_word FROM i18n");
        $arr = $res->result_array();
        $this->lang->load('i18n', $loc_lang);
        foreach ($arr as $tmp)
        {
            $field = "i18n_{$tmp['key_word']}";
            $ary[] = array($tmp['key_word'], $this->lang->line($field));
        }

        $now_lang = $this->lang->line('i18n_language');

        $unread_plurks = 27;
        $data = array(
            'title'             => 'i18n test',
            'list'              => $ary,
            'now_lang'          => $now_lang,
            'unread_plurks'     => $unread_plurks,
            'show_data'         => FALSE,
        );
        $this->load->view("i18n_view_head", $data);
        $this->load->view("i18n_view_body", $data);
    }

    function use_lang($lang=null)
    {
        //setlocale(LC_ALL, "");
        switch($lang)
        {
            case "cn":  putenv("LANG=zh_CN"); break;
            case "jp":  putenv("LANG=ja_JP"); break;
            case "en":  putenv("LANG=en_US"); break;
            case "tw":
            default:    putenv("LANG=zh_TW"); break;
        }
        return getenv("LANG");
    }

    function escape_str($str)
    {
        $str = preg_replace("/'/", "\'", $str);
        return $str;
    }

    function gen($lang=null)
    {
        $loc_lang = $this->use_lang($lang);
        $res = $this->db->query("SELECT key_word, {$loc_lang}_word FROM i18n");
        $arr = $res->result_array();
        $gen_str = "<?php\n";
        foreach ($arr as $ary)
        {
            $field = $loc_lang."_word";
            $gen_str.= "\$lang['i18n_{$ary['key_word']}'] = '{$this->escape_str($ary[$field])}';\n"; 
        }
        $gen_str.= "?>\n";
        $filepath = "/home/www/develop/CI/system/application/language/{$loc_lang}/i18n_lang.php";
        $fh = fopen($filepath, "w+");
        fwrite($fh, $gen_str);
        fclose($fh);
        header('location:/i18n/');
        exit;
    }

    function del($id)
    {
        if (!isset($id)) echo "無 id 參數!";
        else
        {
            $this->db->delete('i18n', array('id' => $id));
            header('location:/i18n/');
            exit;
        }
    }

    function upd()
    {
        $data = array(
            'key_word' => $this->input->post('key_word'),
            'zh_TW_word' => $this->input->post('zh_TW_word'),
            'zh_CN_word' => $this->input->post('zh_CN_word'),
            'ja_JP_word' => $this->input->post('ja_JP_word'),
            'en_US_word' => $this->input->post('en_US_word'),
        );
        $this->db->update('i18n', $data, array('id' => $_POST['id']));
        header('location:/i18n/');
        exit;
    }

    function ins()
    {
        $data = array(
            'key_word'   => $this->input->post('key_word'),
            'zh_TW_word' => $this->input->post('zh_TW_word'),
            'zh_CN_word' => $this->input->post('zh_CN_word'),
            'ja_JP_word' => $this->input->post('ja_JP_word'),
            'en_US_word' => $this->input->post('en_US_word'),
        );
        $this->db->insert('i18n', $data);
        header('location:/i18n/');
        exit;
    }

    function add()
    {
        $this->load->view("i18n_view_body_add");
    }

    function edit($lang=null, $id=null)
    {
        $res = $this->db->query("SELECT * FROM i18n WHERE id='{$id}'");
        $arr = $res->result_array();
        $data = array(
            'title'     => 'i18n test',
            'key_value' => $arr[0],
            'content'   => "內容:"
        );
        $this->load->view("i18n_view_head", $data);
        $this->load->view("i18n_view_body_edit", $data);
    }

    function show($lang=null)
    {
        $res = $this->db->query("SELECT * FROM i18n");
        $arr = $res->result_array();

        $loc_lang = $this->use_lang($lang);
        $this->lang->load('i18n', $loc_lang);
        $now_lang = $this->lang->line('i18n_language');
        $data = array(
            'title'     => 'i18n test',
            'list'      => $arr,
            'now_lang'  => $now_lang,
            'show_data' => TRUE,
        );
        $this->load->view("i18n_view_head", $data);
        $this->load->view("i18n_view_body", $data);
    }
}
?>
