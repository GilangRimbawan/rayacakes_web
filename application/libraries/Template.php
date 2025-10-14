<?php
class Template {
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function load($template_name, $view_name, $data = array())
    {
        $view_data['content'] = $this->CI->load->view($view_name, $data, TRUE);
        $this->CI->load->view($template_name, $view_data);
    }
}