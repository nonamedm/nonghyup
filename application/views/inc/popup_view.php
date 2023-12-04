<!-- application/views/popup_view.php -->

<?php
// 이미지 파일 경로
$imagePath = isset($imagePath) ? $imagePath : '/static/data/popup/06e3ee6a96dd1a71c36c14c997111240.png';

// 쿠키 이름
$cookieName = 'popup_viewed';

// 팝업을 이미 본 경우, 하루 동안 다시 표시하지 않음
if (!isset($_COOKIE[$cookieName])) {
    ?>

    <!-- 이미지 클릭 시 팝업 띄우기 -->
    <!-- <img src="<?php echo $imagePath; ?>" alt="이미지" onclick="showPopup('<?php echo $imagePath; ?>')"> -->
    <div class='uk-placeholder keyword' onclick="showPopup('<?php echo $imagePath; ?>')">팝업띄우기</div>
    <!-- 팝업 영역 -->
    <div id="imagePopup" class="popup"  style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 1px solid #ccc; background-color: #fff; z-index: 1000; max-width: 500px; max-height: 500px;">
        <img src="" alt="팝업 이미지" id="popupImage">
        <div class="popup-btn-area" style="background-color: black; color: #fff; display: flex; justify-content: space-between;">
            <span onclick="onedayClose()" style="cursor: pointer;">하루동안 보지 않기</span>
            <span onclick="closePopup()" style="cursor: pointer;">닫기</span>
        </div>
    </div>

    <?php
}
?>

<script>
    // JavaScript 함수로 팝업 띄우기 및 닫기
    function showPopup(imagePath) {
        var popup = document.getElementById('imagePopup');
        var popupImage = document.getElementById('popupImage');

        // 이미지 경로 설정
        popupImage.src = imagePath;

        // 팝업 보이기
        popup.style.display = 'block';        
    }

    function closePopup() {
        var popup = document.getElementById('imagePopup');

        // 팝업 닫기
        popup.style.display = 'none';
    }
    function onedayClose() {
        var popup = document.getElementById('imagePopup');
        // 쿠키 설정: 팝업을 본 시간을 기록하고, 하루 동안 유지
        var expires = new Date();
        expires.setDate(expires.getDate() + 1);
        document.cookie = 'popup_viewed=true; expires=' + expires.toUTCString() + '; path=/';

        // 팝업 닫기
        popup.style.display = 'none';
    }
</script>
