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

    function add_log($log_arr)
    {
        $userid = $this->session->userdata('user_id');
        $sql = "INSERT INTO commit_log (l_id, s_id, commit_user, comment, commit_time) ";
        $sql.= "VALUES ({$log_arr['l_id']}, {$log_arr['s_id']}, '{$userid}', '{$log_arr['comment']}', '".date("Y-m-d H:i:s")."')";
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
            'translate' => $form_data['translate'],
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

    function get_parent_cate()
    {
    }

    function get_child_cate($pid = 0)
    {
        $sql = "SELECT * FROM page_cate WHERE up_page = {$pid}";
        $res = $this->db->query($sql);
        $arr = $res->result_array();
        $aaa = array();
        if (COUNT($arr))
        {
            foreach($arr as $a)
            {
                $aaa[$a['page_name']] = $this->get_child_cate($a['page_id']);
            }
        }
        else
        {
            $aaa = 0;
        }
        return $aaa;
    }

    function get_page_cate()
    {
        $arr_str = "\$page_cate = array (\n";
        $sql = "SELECT up_page FROM page_cate GROUP BY up_page";
        $res = $this->db->query($sql);
        $grp = $res->result_array();
        foreach ($grp as $g) 
        {
            $arr_str.= "\t'{$g['up_page']}' => array (\n";
            $sql = "SELECT * FROM page_cate WHERE up_page = {$g['up_page']}";
            $res2 = $this->db->query($sql);
            $cat = $res2->result_array();
            foreach($cat as $k => $c)
            {
                $arr_str.= "\t\t'{$k}' => array (\n";
                $arr_str.= "\t\t\t'page_id' => '{$c['page_id']}',\n";
                $arr_str.= "\t\t\t'page_name' => '{$c['page_name']}',\n";
                $arr_str.= "\t\t\t'up_page' => '{$c['up_page']}',\n";
                $arr_str.= "\t\t),\n";
            }
            $arr_str.= "\t),\n";
        }
        $arr_str.= ");\n";
        return $arr_str;
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
