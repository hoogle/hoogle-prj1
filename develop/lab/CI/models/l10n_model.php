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
        $data = array (
            'translate' => $this->db->escape_str($form_data['translate']),
            'last_updater' => $form_data['userid'],
            'update_time' => date("Y-m-d H:i:s"),
            'status' => LANG_RETRANSLATED
        );
        $this->db->update("lang_{$form_data['l_type']}", $data, array("s_id" => $form_data['sid']));
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

    function get_all_lang($params, &$total)
    {
        $cond = ( ! empty($params['sid'])) ? "s_id = '{$params['sid']}'" : 1;
        $order_field = ( ! empty($params['sort'])) ? " ORDER BY {$params['sort']}" : "";
        $desc = ( ! empty($params['dir']) && $params['dir'] == "desc") ? " DESC" : " ASC";
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM lang_{$params['use_lang']} WHERE {$cond} {$order_field}";
        $start = ( ! empty($order_field)) ? $params['start'] : "";
        $results = ( ! empty($order_field)) ? $params['results'] : "";
        $sql.= ( ! empty($order_field)) ? "{$desc} LIMIT {$start}, {$results}" : "";
        $res = $this->db->query($sql);
        $total_res = $this->db->query("SELECT FOUND_ROWS() AS TOTAL_ROWS");
        $total = $total_res->row()->TOTAL_ROWS;
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
