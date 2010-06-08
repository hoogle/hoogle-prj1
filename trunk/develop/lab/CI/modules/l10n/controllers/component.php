<?php
class Component extends Controller {
    public function __construct()
    {
        parent::Controller();
    }

    public function show_cate_select()
    {
        $this->load->model("l10n_model");
        $page_cate = $this->l10n_model->load_page_cate();
        $this->load->view("components/show_cate_select", array("page_cate" => $page_cate));
    }
}
?>
