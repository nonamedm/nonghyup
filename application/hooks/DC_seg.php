<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DC_seg extends CI_Lang {

    protected $CI;

    private $lng_arr = array();
    private $lng_cd;

    function __construct()
    {
        $CI =& get_instance();
    }



    public function get_lng_cd()
    {
        log_message("info", ":::::::::: :::::::::: :::::::::: DC_seq ");

        global $CFG;
        global $URI;

        // this->lng_arr : config 에 설정된 lng_arr array 값을 가져옴
        if ($CFG->config['lng_arr']) {
            $this->lng_arr = $CFG->config['lng_arr'];
        } else {
            show_404("DC_seg :: CFG->config['lng_arr'] 설정값이 없습니다.", TRUE);
        }



        /*
         * ****************************************
         * set svc_mod_arr
         * ****************************************
         */
        $CFG->set_item('svc_mod_arr', array('svc', 'adm', 'mng'));



        /*
         * ****************************************
         * set svc_mod, lng_cd
         * ****************************************
         */
        // set svc_mod, lng_cd
        if ( isset($URI->segments) && count($URI->segments) > 0 )
        {
            if ($URI->segment(1) == "adm")
            {
                // svc_mod - update
                $CFG->set_item('svc_mod', 'adm');
                $CFG->set_item('lng_cd', ''); // session 참조를 위해 강제설정 안함
            } else if ($URI->segment(1) == "mng") {
                // svc_mod - update
                $CFG->set_item('svc_mod', 'mng');
                $CFG->set_item('lng_cd', ''); // session 참조를 위해 강제설정 안함
            } else { // 언어값인 경우

                // this->lng_cd
                if ($URI->segment(1))
                {
                    if (mb_strlen($URI->segment(1))!=2) {
                        show_404('ERROR', 'DC_seg :: URI->segment(1)에 부적절한 값이 요청되었습니다.');
                    }

                    foreach ($this->lng_arr as $value) {
                        if ($value[0] == $URI->segment(1)) { //사용언어 베열에 일치하는 값이 있다면 적용
                            $this->lng_cd = $URI->segment(1);
                            break;
                        }
                    }

                    if ($this->lng_cd) {
                        $CFG->set_item('lng_cd', $this->lng_cd);
                    } else {
                        log_message("DEBUG", "DC_seg :: URI->segment(1)과 일치하는 lng_cd값이 없으므로 무시합니다. URI->segment(1)=" . $URI->segment(1) );
                        $CFG->set_item('lng_cd', '');
                    }

                } else {
                    log_message("DEBUG", "DC_seg :: URI->segment(1)에 부적절한 값이 요청되었으므로 무시합니다. URI->segment(1)=" . $URI->segment(1) );
                    $CFG->set_item('lng_cd', ''); // session 참조를 위해 강제설정 안함
                }
                $CFG->set_item('svc_mod', 'svc');
            }
        } else {
            $CFG->set_item('svc_mod', 'svc');
            // session 참조를 위해 강제설정 안함
            $CFG->set_item('lng_cd', '');
        }


        unset($CFG);
        unset($URI);
    }
}