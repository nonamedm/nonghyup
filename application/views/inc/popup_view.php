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
            
            <!-- 이미지 클릭 시 팝업 띄우기 -->
            <!-- <div class='uk-placeholder keyword' onclick="showPopup('<?php echo $i; ?>')" >팝업띄우기</div> -->
            <!-- 팝업 영역 -->
                <div id="imagePopup<?php echo $i; ?>" class="popup"  style="display: block; position: fixed; left: 10%; border: 1px solid #ccc; background-color: #fff; z-index: 1000; max-width: 500px; max-height: 500px;">
                    <input id="imageName<?php echo $i; ?>" type="hidden" value="<?php echo $imageName; ?>"/>
                    <img src="<?php echo $imagePath; ?>" alt="팝업 이미지" id="popupImage<?php echo $i; ?>" class="popup-image">
                    <div class="popup-btn-area" style="background-color: black; color: #fff; display: flex; justify-content: space-between;">
                        <span onclick="onedayClose('<?php echo $i; ?>')" style="cursor: pointer;">하루동안 보지 않기</span>
                        <span onclick="closePopup('<?php echo $i; ?>')" style="cursor: pointer;">닫기</span>
                    </div>
                </div>
                <script>
                    function movePopup(i) {
                        // cont_body
                        var firstPlace = document.getElementById('content');
                        var topPixel = firstPlace.offsetTop;
                        var leftPixel = firstPlace.offsetLeft;
                        
                        // div 요소 가져오기
                        var divElement = document.getElementById('imagePopup'+i);

                        // 현재 left 값을 가져와서 숫자로 변환
                        var currentLeft = parseFloat(divElement.style.left) || 0;

                        // 새로운 left 값 계산 (현재 값 + 300px)
                        var newLeft = currentLeft + (i*150);

                        // div의 left 속성 설정
                        divElement.style.left = newLeft + 'px';
                        divElement.style.top = topPixel + 'px';
                    }
                </script>
            <?php
                echo "<script>movePopup('" . $i . "');</script>";
            } else {
               
            }
            ?>
<?php
        }
        ?>
        <script>
            // JavaScript 함수로 팝업 띄우기 및 닫기
            function showPopup(i) {
                var popup = document.getElementById('imagePopup'+i);
                var popupImage = document.getElementById('popupImage'+i);

                // 이미지 경로 설정
                //popupImage.src = imagePath;

                // 팝업 보이기
                popup.style.display = 'block';        
            }

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



