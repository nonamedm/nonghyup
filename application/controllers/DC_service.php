<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/DC_common.php';
class DC_service extends DC_common
{
    public function __construct()
    {
        parent::__construct();
    }


    function _remap( $method, $param=array() )
    {
        if( $this->config->item('md')['fnc'] == 'bbs' )
        {
            $this->load->helper('form_helper');
            $this->form_arr = get_form_arr();
        }


        // 카테고리관련 cat
        $this->load->helper('basic_helper');
        $this->load->view("cmmn/common_text");


        /*
         * --------------------------------------------------
           header
         * --------------------------------------------------
         */
        $this->load->view("inc/header", $this->get_param_header() );


        // body
        $this->load->view("inc/body_start");


        /*
         * --------------------------------------------------
           top
         * --------------------------------------------------
         */
        $this->load->view($this->get_svc_mod()."/top");
        

        $this->load->view($this->get_svc_mod()."/visual");



        /*
         * --------------------------------------------------
           content
         * --------------------------------------------------
         */
        $this->load->view($this->get_svc_mod()."/content_start");
        $this->$method($param);
        $this->load->view($this->get_svc_mod()."/content_end");


        /*
         * --------------------------------------------------
           bottom
         * --------------------------------------------------
         */
        $this->load->view($this->get_svc_mod()."/bottom");


        // body
        $this->load->view("inc/body_end");


        /*
         * --------------------------------------------------
           footer
         * --------------------------------------------------
         */
        $this->load->view("inc/footer");
    }
}