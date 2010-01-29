<?php
class Lang extends Controller {
    function __construct()
    {
        parent::Controller();
    }

    function index($use_lang)
    {
        $this->load->database();
        $this->load->model("l10n_model");
        $data = array (
            'list' => $this->l10n_model->get_all_lang($use_lang),
        );
        $this->load->view("rec_list", $data);
    }
}
?>
