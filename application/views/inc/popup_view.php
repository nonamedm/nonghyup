<!-- application/views/popup_view.php -->
<?php 
    $this->db->select('A.*, B.*');
    $this->db->from('ct_popup A');
    $this->db->join('ct_file B', 'A.idx = B.trgt_idx', 'inner');
    $this->db->where('B.trgt_id', 'ct_popup');
    $this->db->where('A.post_status', '1');
    $this->db->where('A.post_dtms <=', "DATE_FORMAT(NOW(),'%Y-%m-%d')", false);
    $this->db->where('A.post_keyword >=', "DATE_FORMAT(NOW(),'%Y-%m-%d')", false);
    $this->db->order_by('A.post_dtms', 'asc');
    $this->db->order_by('A.crt_dtms', 'asc');
    $query = $this->db->get();
    $result = $query->result();
    $res = json_decode(json_encode($result), true);
    $count = count($res);
    if($res)
    {
        for ($i=0; $i<$count; $i++) {
            // 이미지 파일 경로
            $imagePath = isset($res[$i]['file_name']) ? '/static/data/popup/'.$res[$i]['file_name'] : '/static/data/popup/06e3ee6a96dd1a71c36c14c997111240.png';
            // 이미지 파일 이름
            $imageName = isset($res[$i]['raw_name']) ? $res[$i]['raw_name'] : '06e3ee6a96dd1a71c36c14c997111240.png';
            
            // 쿠키 이름
            $cookieName = 'popup_viewed_'.$imageName;
            
            // 팝업을 이미 본 경우, 하루 동안 다시 표시하지 않음
            if (!isset($_COOKIE[$cookieName])) {
            ?>
            
            <!-- 팝업 영역 -->
                <div id="imagePopup<?php echo $i; ?>" class="popup"  style="display: block; position: absolute; left: 10%; border: 1px solid #ccc; background-color: #fff; z-index: 1000; max-width: 500px; ">
                    <input id="imageName<?php echo $i; ?>" type="hidden" value="<?php echo $imageName; ?>"/>
                    <?php 
                        if(!$res[$i]['post_link_addr']=='') {
                    ?>
                        <a href="<?php echo $res[$i]['post_link_addr']; ?>" target="_blank">
                            <img src="<?php echo $imagePath; ?>" alt="팝업 이미지" id="popupImage<?php echo $i; ?>" class="popup-image" style="max-width: 450px; ">
                        </a>
                    <?php
                        } else {
                    ?>
                        <img src="<?php echo $imagePath; ?>" alt="팝업 이미지" id="popupImage<?php echo $i; ?>" class="popup-image" style="max-width: 450px; ">
                    <?php
                        }
                    ?>
                    <div class="popup-btn-area" style="background-color: black; color: #fff; display: flex; justify-content: space-between;">
                        <span onclick="onedayClose('<?php echo $i; ?>')" style="cursor: pointer;">하루동안 보지 않기</span>
                        <span onclick="closePopup('<?php echo $i; ?>')" style="cursor: pointer;">닫기</span>
                    </div>
                </div>
                <script>
                    function movePopup(i) {
                        // cont_body
                        var firstPlace = document.querySelectorAll('.gnb')[0];
                        console.log(firstPlace);
                        var topPixel = firstPlace.offsetTop + 40;
                        var leftPixel = firstPlace.offsetLeft;
                        
                        // div 요소 가져오기
                        var divElement = document.getElementById('imagePopup'+i);

                        // 현재 left 값을 가져와서 숫자로 변환
                        var currentLeft = parseFloat(divElement.style.left) || 0;

                        // 새로운 left 값 계산 (현재 값 + 300px)
                        var newLeft = currentLeft + (i*150) + 590;

                        // div의 left 속성 설정
                        divElement.style.left = newLeft + 'px';
                        divElement.style.top = topPixel + 'px';
                    }
                    function openNewWindow(i) {
                        // 새 창 열기
                        var newWindow = window.open('', '_blank', 'width=500,height=500');

                        // 창 내용 설정
                        if (newWindow) newWindow.document.write('<html><head><title>팝업</title></head><body>');
                        if (newWindow) newWindow.document.write(document.getElementById('imagePopup'+i).innerHTML);
                        if (newWindow) newWindow.document.write('</body></html>');

                        // 창 내용을 쓴 후 document를 닫아줌
                        //newWindow.document.close();
                    }
                </script>
            <?php
                echo "<script>movePopup('" . $i . "'); //openNewWindow('" . $i . "');</script>";
            } else {
               
            }
            ?>
<?php
        }
        ?>
        <script>
            function closePopup(i) {
                var popup = document.getElementById('imagePopup'+i);

                // 팝업 닫기
                popup.style.display = 'none';
            }
            function onedayClose(i) {
                var popup = document.getElementById('imagePopup'+i);
                // 쿠키 설정: 팝업을 본 시간을 기록하고, 하루 동안 유지
                var expires = new Date();
                expires.setDate(expires.getDate() + 1);
                document.cookie = 'popup_viewed_'+document.getElementById('imageName'+i).value+'=true; expires=' + expires.toUTCString() + '; path=/';

                // 팝업 닫기
                popup.style.display = 'none';
            }
            function onedayCloseCancel(i) {
                var popup = document.getElementById('imagePopup'+i);
                // 쿠키 설정: 팝업을 본 시간을 기록하고, 하루 동안 유지
                var expires = new Date();
                expires.setDate(expires.getDate());
                document.cookie = 'popup_viewed_'+document.getElementById('imageName'+i).value+'=false; expires=' + expires.toUTCString() + '; path=/';

                // 팝업 닫기
                popup.style.display = 'none';
            }
            
        </script>
<?php
        
        return $res;
    } else {
        return false;
    }
?>



