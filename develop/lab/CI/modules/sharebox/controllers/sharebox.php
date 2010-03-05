<?php
class Sharebox extends Controller {
    function __construct()
    {
        parent::Controller();
    }

    function index()
    {
        $this->load->view("index");
    }
}
