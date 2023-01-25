<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_structure
{
    private $rtn_tree = array();
    protected $schema_arr = array();
    private $md_max, $brk;



    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        log_message("info", "Load library -> DL_structure");

        // 재귀(Depth) Count
        $this->md_max = 4;
        $this->brk = TRUE;

        //
        $this->schema_arr = array(
            'id'            => ''
            ,'idx'          => ''
            ,'tit'          => ''
            ,'typ'         => ''
            ,'fnc'         => ''
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'          => ''
            ,'fld'          => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'	        => ''
        );

    }




    /*
     * ****************************************
     * get_structure
     * ****************************************
     */
    public function get_structure($_str = "") {
        $rtn = null;
        if ($_str) {
            if ($_str == 'auth') {
                $rtn = $this->CI->get_tree('auth');
            } else if($_str == 'usr') {
                $rtn = $this->CI->get_tree('usr');
            } else {
                show_404("DL_structure get_structure param error", TRUE);
            }
        } else {
            $rtn = $this->CI->get_tree();
        }
        return $rtn;
    }






    /*
     * ****************************************
     * get_md
     * 1. $_tree_arr : 대상구조
     * 2. $_dpth : 현재심도
     * 3. $_m_id : 메뉴아이디
     * 4. $_path_arr : 경로값
     * ****************************************
     */
    public function get_md( $_tree_arr, $_dpth, $_mid, $_path_arr=array(), $_rtn_gd=array() )
    {
        //echo "재귀시작".$_dpth."<br>";
        $rtn['md'] = $this->schema_arr;
        //print_r($rtn['md']);
        //echo "_rtn_gd=".count($_rtn_gd);
        //if(count($_rtn_gd)){
            //echo "___rtn_gd";
        $rtn['gd'] = $_rtn_gd;
        //print_r($rtn['gd']);
        //}else{

        //}


        if ($_dpth < $this->md_max) {

            // 현재 대상구조의 갯수만큼 for 반복
            for ($i=0; $i<count($_tree_arr); $i++) {

                // 경로저장
                $_path_arr[$_dpth] = $_tree_arr[$i];
                if($_dpth==1){
                    $_path_arr[$_dpth]['idx'] = $i;
                }

                // 하위구조 제거
                //$_path_arr[$_dpth]['sub']='';

                //print_r($_path_arr[$_dpth]);

                //echo "-- for ".$_tree_arr[$i]['id']." : ".$_mid."<br>";
                if ($_tree_arr[$i]['id'] == $_mid) {
                    //echo "-- -- 일치".$_tree_arr[$i]['id']."<br>";
                    //print_r($rtn['gd']);
                    if ($_tree_arr[$i]['typ'] != 'label') {
                        //echo "-- -- -- !label".$_tree_arr[$i]['typ']."<br>";
                        $rtn['path_arr'] = $_path_arr;
                        //echo "== == == _d=".$_dpth."<br>";
                        //print_r($rtn['path_arr']);
                        //echo "-- -- -- _d=".$_dpth."<br>";
                        if($_dpth==0){
                            //echo $_dpth;

                            //$rtn['gd']= array();
                        }

                        $rtn['gd'] = $_tree_arr;

                        //echo "이전<br>";
                        //print_r($rtn['gd']);
                        //echo "<br>".$i."<br>";
                        //print_r($_tree_arr[$i]);
                        //print_r($rtn['path_arr'][1]);
                        $rtn = $this->set_inherit($rtn['path_arr'], $_tree_arr[$i], $_dpth, $_mid, $rtn['gd']);

                        //echo "이후<br>";
                        //print_r($rtn['gd']);
                        //print_r($rtn['path_arr'][1]);
                        //echo "++ ++ ++ _d=".$_dpth."<br>";

                        if ($_dpth) {
                            //echo "-- -- -- !label if return <br>";
                            //$brk = false;
                            //print_r($rtn);
                            return $rtn;
                        } else {
                            break;
                        }
                    }
                }


                if ($_tree_arr[$i]['sub'] && $_tree_arr[$i]['fnc']!='bbs') {
                    //echo "-- for sub가 있다면 ".$_tree_arr[$i]['id']."<br>";
                    if ($_tree_arr[$i]['typ'] == 'label' && $_tree_arr[$i]['id'] == $_mid) {
                        $_mid = $_tree_arr[$i]['sub'][0]['id'];
                    }
                    if($_dpth==1){
                        $rtn['gd'][$i]['idx']= $i;
                    }
                    //echo "---".$i."<br>";
                    //print_r($rtn['gd']);
                    //echo "===<br>";
                    // 재귀호출
                    $r_rtn = $this->get_md($_tree_arr[$i]['sub'], ($_dpth+1), $_mid, $_path_arr, $rtn['gd']);
                    if (isset($r_rtn['md']['id']) &&  $r_rtn['md']['id']) {
                        $rtn = $r_rtn;
                    }
                    if( $_tree_arr[$i]['typ'] == 'label' ){

                    }
                }
            }
        }
        if ($rtn['md']['id']) {
            $rtn['md']['sub'] = '';
            return $rtn;
        }
    }


    /*
     * ****************************************
     * set_inherit : 상속처리
     * ****************************************
     */
    private function set_inherit ($_path_arr, $_md_arr, $_dpth, $_mid, $_gd_arr=array()) {
        //$opt_arr = ['id','fnc']; //'mod','cat','tbl','fld','skin','perm','status','lng_mode_yn','visible_yn','file','edtr'
        $opt_arr = ['id','fnc','mod','cat','tbl','fld','skin','perm','status','lng_mode_yn','visible_yn','file','edtr']; //'mod','cat','tbl','fld','skin','perm','status','lng_mode_yn','visible_yn','file','edtr'
        //print_r($_gd_arr);
        $rtn = array();
        if($_dpth>0) {
            if ($_path_arr[$_dpth]['id'] == $_mid) {
                for ($i=0; $i<count($opt_arr); $i++) {
                    $opt = $this->get_inherit($_path_arr, $_dpth, $opt_arr[$i]);
                    $_path_arr[$_dpth][$opt_arr[$i]] = $opt;
                    $_md_arr[$opt_arr[$i]] = $opt;
                }
                $rtn['gd'] = $_gd_arr;
            }
        }else{
            $rtn['gd'] = $_gd_arr[0]['sub'];
        }
        $rtn['md'] = $_md_arr;
        $rtn['path_arr'] = $_path_arr;

        return $rtn;
    }



    /*
     * ****************************************
     * get_inherit :
     * ****************************************
     */
    public function get_inherit($_path_arr, $_idx, $_opt, $_stat="") {
        $rtn = '';
        if ($_path_arr[$_idx][$_opt] == '') {
            if ($_idx>0) {
                $rtn = $this->get_inherit($_path_arr, $_idx-1, $_opt, $_idx-1);
            } else {
                $rtn = $_path_arr[$_idx][$_opt];
            }
        } else {
            if ($_path_arr[$_idx][$_opt] == 'label' && $_stat != "") {
                $_path_arr[$_idx][$_opt] = 'cont';
            }
            $rtn = $_path_arr[$_idx][$_opt];
        }
        return $rtn;
    }





}