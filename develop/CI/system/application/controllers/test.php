<?
class Test extends Controller {
    function Test()
    {
        parent::Controller();
        $this->load->scaffolding('test');
    }

    function index()
    {
        $this->config->load('myconfig');
        $a = $this->config->item('hoogle_blood');
        echo "Test YA => {$a}";
        //$dsn = 'mysql://trip:enjoy@localhost/CI';
        //$this->load->database($dsn);
        /*
        $this->load->database();
        $this->db->select('title')->from('album');
        $res = $this->db->get();
         */
        $q = $this->load->database('W3', TRUE);
        $res = $q->query('select * from album');
        $arr = $res->result();
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function comments($article_id)
    {
        $this->lang->load('test', 'zh_TW');
        //$this->lang->load('test');
        $mytest = $this->lang->line('test_mytest');
        $data = array(
            'title' => "標題",
            'content' => "內容 : {$mytest}",
            'article_id' => $article_id,
        );
        $this->load->view("test_view_head", $data);
        $this->load->view("test_view_body", $data);
    }
}
?>
