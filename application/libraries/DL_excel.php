<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
class DL_excel extends PHPExcel
{
    // ***** 정렬기준
    public $orderBy = " idx DESC, crt_dtms DESC ";




    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        // PHPExcel 라이브러리 로드
        $this->CI->load->library('PHPExcel');
        // 워크시트에서 1번째는 활성화
        $this->CI->phpexcel->setActiveSheetIndex(0);
    }



    /*
     * ****************************************
     * S A V E E X C E L
     * ****************************************
     */
    public function saveExcel($_id='', $_cat='', $_cat_nm='' ){

        $this->CI->load->database();

        if($_id=='usr') {
            // DB에서 값을 가져온다
            $param_cm = array(
                'tb_id' => 'ct_usr'
            ,'usr_typ' => '10'
            );

            if($_cat){
                $param_cm['usr_schl_cd']=$_cat;
            }

            $data = $this->CI->DM_basic->getListSdct($param_cm);
        }else if($_id=='quiz'){
            // DB에서 값을 가져온다
            $param_cm = array(
                'tb_id' => 'ct_quiz'
            ,'order' => ' wr_date DESC, wr_program DESC, wr_nm DESC, wr_email DESC '
            );
            $data = $this->CI->DM_basic->getListQuiz($param_cm);
        }else{
            $param_cm = array(
                'tb_id' => 'ct_usr'
            ,'order' => ' post_typ ASC, idx DESC '
            );
            $data = $this->CI->DM_basic->getList($param_cm);
        }



        $sheetIdx = 0;
        $this->CI->phpexcel->createSheet();
        $this->CI->phpexcel->setActiveSheetIndex($sheetIdx);
        $this->CI->phpexcel->getActiveSheet()->setTitle("sheet_".$sheetIdx);

        $fld_excel = $this->CI->dl_schema->get_schema($_id.'_excel');

        $fld_cd_arr=[];
        $fld_nm_arr=[];
        foreach($fld_excel as $key=>$val){
            array_push($fld_cd_arr, $key); // cd array
            array_push($fld_nm_arr, $val); // name array
        }

        $fieldIdx = 0;
        //$fld_nm_arr = explode (",", $fields);
        foreach ($fld_nm_arr as $kk => $vv) {
            $this->CI->phpexcel->getActiveSheet()->setCellValueByColumnAndRow($fieldIdx, 1, $vv);
            //$this->CI->phpexcel->getActiveSheet()->getColumnDimension($vv)->setAutoSize(true); // 컬럼폭 조정
            $fieldIdx++;
        }

        //var_dump($data);

        $valIdx = 2;
        foreach ($data as $row)
        {
            $fieldIdx = 0;
            if($_id=='usr') {
                if ($row['usr_status'] != '') {
                    if ($row['usr_status'] == '1') {
                        $row['usr_status'] = '승인완료';
                    } else {
                        $row['usr_status'] = '미승인';
                    }
                }
                if ($row['usr_lv']) {
                    if ($row['usr_lv'] == '2') {
                        $row['usr_lv'] = '미인증';
                    } else if ($row['usr_lv'] == '3') {
                        $row['usr_lv'] = '인증완료';
                    }
                }
            }

            foreach ($fld_cd_arr as $k => $v) {
                $this->CI->phpexcel->getActiveSheet(0)->setCellValueByColumnAndRow($fieldIdx, $valIdx, $row[$v].' '); // 문자로 처리하기위한 편법(공백 추가)
                //$this->CI->phpexcel->getActiveSheet(0)->setCellValueByColumnAndRow($fieldIdx, $valIdx, $row[$v]);
                //$this->CI->phpexcel->getActiveSheet()->getColumnDimension($v)->setAutoSize(true); // 컬럼폭 조정
                $fieldIdx++;
            }
            $valIdx++;
        }

        if($_id=='usr') {
            if ($_cat_nm) {
                $filename = iconv('UTF-8', 'EUC-KR',$_cat_nm.'_심사위원_excel.xls'); // 엑셀 파일 이름
            } else {
                $filename = iconv('UTF-8', 'EUC-KR','전체_심사위원_excel.xls'); // 엑셀 파일 이름
            }
        }else{
            $filename = iconv('UTF-8', 'EUC-KR',$_id.'_excel.xls'); // 엑셀 파일 이름
        }

        header( "Content-type: application/vnd.ms-excel;charset=utf-8");
        header('Content-Type: application/vnd.ms-excel'); //mime 타입
        header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
        header('Cache-Control: max-age=0'); //no cache

        // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
        $objWriter = PHPExcel_IOFactory::createWriter($this->CI->phpexcel, 'Excel5');

        // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
        $objWriter->save('php://output');

    }
}