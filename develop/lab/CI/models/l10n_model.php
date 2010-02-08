<?php
class L10n_model extends Model {

    function __construct()
    {
        parent::Model();
    }

    function set_user_stat($userid)
    {
        $now_time = date("Y-m-d H:i:s");
        $sql = "UPDATE users SET last_login = '{$now_time}' ";
        $sql.= "WHERE user_id = '{$userid}'";
        $this->db->query($sql);
    }

    function add_newlang($data)
    {
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');
        foreach ($lang_arr as $lang_item)
        {
            if ($lang_item['l_type'] == "en_US")
            {
                $id_fields = "";
                $id_value = "";
            }
            else
            {
                $id_fields = "s_id, ";
                $id_value = "{$new_sid}, ";
            }
            $sql = "INSERT INTO lang_{$lang_item['l_type']} ({$id_fields}key_word, translate, original, create_time, update_time, last_updater, status) VALUES ";
            $sql.= "({$id_value}'{$data['key_word']}', ".$this->db->escape($data['langs'][$lang_item['l_type']]).", ".$this->db->escape($data['langs'][$lang_item['l_type']]).", NOW(), NOW(), '{$userid}', ".LANG_TRANSLATE_NEW.")";
            $this->db->query($sql);
            if ($lang_item['l_type'] == "en_US")
            {
                $new_sid = $this->db->insert_id();
            }
        }
    }

    function edit_lang($form_data)
    {
        $userid = $this->session->userdata('user_id');
        $lang_arr = $this->session->userdata('lang_perm');
        foreach ($lang_arr as $lang_item)
        {
            $data = array (
                'translate' => $this->db->escape_str($form_data['langs'][$lang_item['l_type']]),
                'last_updater' => $userid,
                'update_time' => date("Y-m-d H:i:s"),
                'status' => LANG_RETRANSLATED
            );
            $this->db->update("lang_{$lang_item['l_type']}", $data, array("s_id" => $form_data['sid']));
        }
    }

    function get_userdata($userid)
    {
        $sql = "SELECT * FROM users WHERE user_id = '{$userid}'";
        $res = $this->db->query($sql);
        $user_arr = $res->result_array();
        return $user_arr[0];
    }

    function get_languages($bit_arr = NULL)
    {
        $sql = "SELECT * FROM languages";
        if ( ! is_null($bit_arr)) $sql.= " WHERE bit_id in ({$bit_arr})";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_all_lang($lang = "en_US", $sid = NULL)
    {
        $sql = "SELECT * FROM lang_{$lang}";
        $sql.= ( ! is_null($sid)) ? " WHERE s_id = {$sid}" : "";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_retranslated($lang = "en_US")
    {
        $sql = "SELECT * FROM lang_{$lang} WHERE status = ".LANG_RETRANSLATED;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
?>
