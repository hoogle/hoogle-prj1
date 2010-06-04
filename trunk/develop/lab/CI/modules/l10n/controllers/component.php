<?php
class Component extends Controller {
    public function __construct()
    {
        parent::Controller();
    }

    public function show_cate_select()
    {
        if ( ! require_once(APPPATH.'config/page_cate.php'))
        {
            return FALSE;
        }

        $this->load->view("components/show_cate_select", array("page_cate" => $page_cate));
    }
}
?>
