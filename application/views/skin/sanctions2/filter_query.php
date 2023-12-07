<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    // 중복 제거된 결과를 담을 배열 초기화
    $resultArray = array();

    // 파라미터 값
    $param = isset($param) ? $param : '""';

    // 중복 제거된 결과를 얻기 위한 쿼리 실행
    if($param) {
        $this->db->select('DISTINCT('.$param.')');
        $this->db->from('ct_sanctions');
        $this->db->order_by($param, 'asc');
        $query = $this->db->get();
        $result = $query->result();
        $res = json_decode(json_encode($result), true);
        $count = count($res);
        if($res) {
            //echo '<select id="sumoSelectId" name="sumoSelectName" multiple="multiple" class="sumoselect_multiple" onchange="handleChange(this.value)" style="display:none;">';
            
            switch($param) {
                case 'post_cat':
                    echo '<select id="sumoSelectId" name="sumoSelectName" multiple="multiple" class="sumoselect_multiple post_cat_multiple" onchange="handleChange(this.value)" style="display:none;">';
                    break;
                case 'post_field':
                    echo '<select id="sumoSelectId" name="sumoSelectName" multiple="multiple" class="sumoselect_multiple post_field_multiple" onchange="handleChange(this.value)" style="display:none;">';
                    break;
                default:
                    echo '';
            }
            
            for ($i=0; $i<$count; $i++) {            
                if($res[$i][$param]!=='') {
                    echo '<option value="'.$res[$i][$param].'">';
                    echo $res[$i][$param];
                    echo '</option>';
                }
            }
            echo '</select>';
            
            for ($i=0; $i<$count; $i++) {            
                if($res[$i][$param]!=='') {
                    echo '<input type="hidden" id="'.$param.''.$i.'" value="'.$res[$i][$param].'" />';
                }
            }
            echo '<input type="hidden" id="'.$param.'_filter_value" value="'.$count.'" />';
        } else {
            return false;
        }
    }
?>