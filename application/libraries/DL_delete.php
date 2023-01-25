<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_delete
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }



    /*
     * ****************************************
     * C M - D E L E T E
     * ****************************************
     */
    public function delete_cm($param)
    {
        if($param)
        {
            $this->CI->load->database();

            $idx = $this->CI->get_val('p_idx');
            //$idx = $this->CI->input->post('idx', TRUE);
            $m_id = $param[0];
            $upload_file_str = "";

            if($idx)
            {
                if($this->CI->config->item('md')['file']){
                    $param_file = array(
                        'tb_id' => 'ct_file',
                        'trgt_id' => $this->CI->config->item('md')['tbl'],
                        'trgt_idx' => $idx
                    );
                    $files = $this->CI->DM_basic->getFiles($param_file);

                    // 파일삭제
                    if(count($files)){
                        for( $i=0; $i<count($files); $i++ )
                        {
                            if(isset($files[$i]['full_path']) && $files[$i]['full_path'])
                            {
                                $this->file_delete($files[$i]['full_path']);
                            }
                        }

                        // 파일정보 삭제
                        $this->CI->db->delete( 'ct_file', array(
                            'trgt_id'=>$this->CI->config->item('md')['tbl'],
                            'trgt_idx' => $idx
                        ));
                    }
                }


                // 답변글이라면 원글의 답변 카운트 조정
                $param_cm = array(
                    'tb_id' => $this->CI->config->item("md")['tbl']
                    ,'idx'  => $idx
                );
                $res = $this->CI->DM_basic->getView($param_cm);
                if($res['ord']==0){ // 원글이라면 답글삭제

                }else{ // 답글이라면 답글카운트 조정
                    $param_ord=[
                        'tb_id'     => $this->CI->config->item('md')['tbl']
                        ,'trgt_idx' => $res['trgt_idx']
                        ,'trgt_id'  => 'ord'
                    ];
                    $ord_arr = $this->CI->DM_basic->getMaxCnt($param_ord);
                    $ord_arr['ord']--;
                    $param_update=array(
                        "tb_id"         => $this->CI->config->item('md')['tbl'],
                        "idx"           => $res['trgt_idx'],
                        "trgt_id"       => "post_reply_cnt",
                        "trgt_val"      => $ord_arr['ord']
                    );
                    $this->CI->DM_basic->updateCnt($param_update);
                }






                // 좋아요 삭제
                $this->CI->db->delete( 'ct_like', array('trgt_id' => $this->CI->config->item('md')['tbl'], 'trgt_idx' => $idx));

                // 코멘트 삭제
                $this->CI->db->delete( 'ct_comment', array('trgt_id' => $this->CI->config->item('md')['tbl'], 'trgt_idx' => $idx));

                // 게시글 삭제
                $result = $this->CI->db->delete( $this->CI->config->item('md')['tbl'], array('idx' => $idx));
            }else{
                echo "게시글 삭제 에러";
            }


            if($result) // 게시물이 정상적으로 삭제되었다면
            {
                $this->CI->session->set_flashdata('message', '정상적으로 삭제되었습니다.', 'refresh');
                //if($this->CI->c_mode){
                //    redirect($this->c_md_arr[0].'/'.$this->c_cfg_arr['md']['id'].'/'.$this->c_cfg_arr['md']['mod']);
                //}else{
                $param_rtn = array(
                    'seg'       =>  $this->CI->get_val('seg')
                    ,'m_id'     =>  $this->CI->get_val('m_id')
                    ,'mod'     =>  "lists"
                    ,'idx'      =>  ''
                    ,'pg'       =>  ''
                );
                $rtn_path = $this->CI->dl_config->get_path_rtn($param_rtn);
                //var_dump( $rtn_path );
                redirect( $rtn_path );

            }else{ // 등록 저장 에러
                $this->session->set_flashdata('message', 'error (DB delete error)', 'refresh');
//                redirect('/');
            }
        }else{
            $this->session->set_flashdata('message', 'ERROR : $param값이 없습니다.', 'refresh');
//            redirect('/');
        }

    }



    /*
     * ****************************************
     * F I L E - D E L E T E
     * ****************************************
     */
    public function file_delete($target_file)
    {
        $rtn = false;
        //파일 삭제
        if( file_exists( $target_file ) )
        {
            unlink( $target_file ); // 잘 동작함
            $rtn = true;
        }
        return $rtn;
    }
}