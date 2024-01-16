<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 목록 :: 시작-->

    <?php
    // ***** bbs title
    //$this->load->view("inc/cont_tit");

    // ***** bbs search
    if ($svc_mod=='adm') {
        // $this->load->view("brd/adm_search");
        $this->load->view("skin/sanctions2/common_search");
    } else {
        $this->load->view("skin/sanctions2/common_search");
    }


    // ***** bbs sort
    $this->load->view("brd/common_sort");

    // ***** bbs list
    ?>
    <?php 
        $post_cat_filter = isset($_COOKIE['post_cat_filter']) ? $_COOKIE['post_cat_filter'] : '';

        // 가져온 데이터를 역직렬화하여 배열로 변환
        if($post_cat_filter!='') $post_cat_filter_array = explode(',', $post_cat_filter);
        //echo print_r($post_cat_filter_array);


        $post_field_filter = isset($_COOKIE['post_field_filter']) ? $_COOKIE['post_field_filter'] : '';

        // 가져온 데이터를 역직렬화하여 배열로 변환
        if($post_field_filter!='') $post_field_filter_array = explode(',', $post_field_filter);
        //echo print_r($post_field_filter_array);


    ?>
    <div class="brd_bdy uk-overflow-auto" style="min-height: 450px;">
        <?php if( count($lists) ){ ?>
            <table class="uk-table uk-table-small uk-table-divider">
                <thead class="wth">
                    <tr>
                        <th class="w40" style="width:5%;">번호</th>
                        <th class="w40" style="width:10%;">제재조치요구일</th>
                        <th class="filter" style="width:10%;">
                            <?php 
                                $data['param'] = 'post_cat';
                                $this->load->view("skin/sanctions2/filter_query",$data); 
                            ?>
                        </th>
                        <th class="tit" style="width:50%;">제목</th>
                        <th class="filter" style="width:15%;">
                            <?php 
                                $data['param'] = 'post_field';
                                $this->load->view("skin/sanctions2/filter_query",$data); 
                            ?>
                        </th>
                        <?php if($is_adm_mod){ ?>
                            <th class="no">좋아요</th>
                            <th class="no">댓글수</th>
                            <th class="no">조회수</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody id="filter_list_body">
                    <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                        <tr class="mtr <?php
                        if ($lists[$i]['post_fix'] == 'Y') echo "fix"; ?>" <?php if ($lists[$i]['post_fix'] == 'Y') echo "style=background-color:#f4f4f4"; ?>>
                            <td class="" colspan="2">
                                <div class="tit">
                                    <?php if($lists[$i]['post_link_addr'] && !$is_adm_mod){ ?>
                                    <a href="<?php echo $lists[$i]['post_link_addr'];?>" target="<?php echo $lists[$i]['post_link_trgt'];?>" class="chk_perm_view">
                                    <?php }else{ ?>
                                    <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                    <?php } ?>
                                        <?php echo $lists[$i]['post_subj'];?>
                                    </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                                    <?php if($lists[$i]['post_link_addr']){ ?><span class="uk-label link">외부링크연결</span><?php } ?>
                                </div>
                                <div class="caption">
                                    <span class="cat"><?php echo $lists[$i]['post_status'];?> 
                                    <?php if($lists[$i]['post_fix'] == 'Y') echo '-'; else echo "(".$lists[$i]['post_cat'].")";?></span>
                                    <span class="cat"><?php echo $lists[$i]['post_field'];?></span>
                                    <span class="cat"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></span>
                                </div>
                            </td>
                        </tr>
                        <tr class="wtr <?php if ($lists[$i]['post_fix'] == 'Y') echo "fix";?>"
                            <?php if ($lists[$i]['post_fix'] == 'Y') echo "style=background-color:#f4f4f4"; ?>>
                            <td class="w40"><?php if($lists[$i]['post_fix'] == 'Y') echo '-'; else echo $li_idx; ?></td>
                            <td class="w40"><?php echo $lists[$i]['crt_dtms'];?></td>
                            <td class="w170">
                                <?php echo $lists[$i]['post_cat'];?>
                            </td>
                            <td class="tit" id="tit<?php echo $i;?>">
                                <?php if($lists[$i]['post_link_addr'] && !$is_adm_mod){ ?>
                                <a href="<?php echo $lists[$i]['post_link_addr'];?>" target="<?php echo $lists[$i]['post_link_trgt'];?>" class="chk_perm_view">
                                <?php }else{ ?>
                                <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                <?php } ?>
                                    <?php echo $lists[$i]['post_subj'];?><span class="uk-label hidden" id="post_summary<?php echo $i;?>"><?php echo $lists[$i]['post_summary'];?></span>

                                </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                                    <?php if($lists[$i]['post_link_addr']){ ?><span class="uk-label link">외부링크연결</span><?php } ?>
                            </td>
                            <td class="w170"><?php echo $lists[$i]['post_field'];?></td>
                            <?php if($is_adm_mod){ ?>
                                <td class="no"><?php echo $lists[$i]['post_like'];?></td>
                                <td class="no"><?php echo $lists[$i]['post_cmt_cnt'];?></td>
                                <td class="no"><?php echo $lists[$i]['post_hit'];?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <?php if( $lists_mode=="sch" ){ ?>
                <?php $this->load->view("brd/common_lists_nosearch");?>
            <?php }else{ ?>
                <?php $this->load->view("brd/common_lists_nopost");?>
            <?php } ?>
        <?php } ?>
    </div>
    <script>
        window.onload = async function () {
            await $(".post_cat_multiple option:selected").prop("selected", false);
            var post_cat_sumo = await $('.post_cat_multiple').SumoSelect({
                placeholder: '위반법률',
                selectAll: 0,
                captionFormat: '{0} 개 선택됨',
                captionFormatAllSelected:'{0} 개 선택됨',
                csvDispCount: 2,
                search: 1,
                noMatch: "검색중 \"{0}\"",
                okCancelInMulti: 1
            });            
            
            <?php
                // 기존 선택된 필터 재선택(쿠키값에 의해 1시간동안 보존)
                if($post_cat_filter!='') {
                    for ($i=0; $i<count($post_cat_filter_array); $i++) {
            ?>
                        post_cat_sumo.sumo.selectItem('<?php echo $post_cat_filter_array[$i]; ?>');
            <?php                                                
                    }
                }
            ?>
            
            await $(".post_field_multiple option:selected").prop("selected", false);
            var post_field_sumo = await $('.post_field_multiple').SumoSelect({
                placeholder: '제재대상기관',
                selectAll: 0,
                captionFormat: '{0} 개 선택됨',
                captionFormatAllSelected:'{0} 개 선택됨',
                csvDispCount: 2,
                search: 1,
                noMatch: "검색중 \"{0}\"",
                okCancelInMulti: 1
            });

            <?php
                // 기존 선택된 필터 재선택(쿠키값에 의해 1시간동안 보존)
                if($post_field_filter!='') {
                    for ($i=0; $i<count($post_field_filter_array); $i++) {
            ?>
                        post_field_sumo.sumo.selectItem('<?php echo $post_field_filter_array[$i]; ?>');
            <?php                                                
                    }
                }
            ?>
            
            await $('.sumoselect_multiple').css('display','block');

            $(".btnOk").on("click", function () {
                var post_cat_filter = $('.post_cat_multiple option:selected').map(function() {
                    return this.value;
                }).get();
                var post_field_filter = $('.post_field_multiple option:selected').map(function() {
                    return this.value;
                }).get();
                
                // 기존 검색값이 있는 경우
                var s_word = '<?php if($s_word) echo $s_word; ?>';
                var s_subj = '<?php if($s_subj) echo $s_subj; ?>';
                var s_cont = '<?php if($s_cont) echo $s_cont; ?>';
                if (post_cat_filter.length===0 && post_field_filter.length===0) {
                    var expires = new Date();
                    expires.setDate(expires.getDate());
                    document.cookie = 'post_cat_filter=false; expires=' + expires.toUTCString() + '; path=/';
                    document.cookie = 'post_field_filter=false; expires=' + expires.toUTCString() + '; path=/';
                    location.reload();
                } else {
                    $.ajax({
                        url: '/ko/ajax/get_filter_list',
                        type: 'get',
                        data : {
                            'post_cat_filter' : post_cat_filter,
                            'post_field_filter' : post_field_filter,
                            's_word' : s_word,
                            's_subj' : s_subj,
                            's_cont' : s_cont,
                        },
                        dataType: 'json',
                        async: false,
                        success: function(data) {
                            console.log(data);
                            var body_row = $("#filter_list_body");
                            var body_cont = '';
                            var li_idx = data.length;
                            for(var i=0; i<data.length; i++, li_idx--) {
                                body_cont += '<tr class="mtr ';
                                if(data[i].post_fix=='Y') body_cont += ' fix';
                                body_cont += '" >';
                                body_cont += '<td class=""><div class="tit">';
                                body_cont += '<a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx='+data[i].idx+'" class="chk_perm_view">';
                                body_cont += data[i].post_subj+'</a></div>';
                                body_cont += '<div class="caption">';
                                body_cont += '<span class="cat">'+data[i].post_status+'('+data[i].post_cat+')</span>';
                                body_cont += '<span class="cat">'+data[i].post_field+'</span>';
                                body_cont += '<span class="cat">'+data[i].crt_dtms.substr(2,8)+'</span>';
                                body_cont += '</div></td></tr>';
    
                                body_cont += '<tr class="wtr"';
                                if(data[i].post_fix=='Y') body_cont += ' style="background-color:#f4f4f4"';
                                body_cont += '><td class="w40">';
                                if(data[i].post_fix=='Y') {
                                    body_cont += '-';
                                } else {
                                    body_cont += li_idx;
                                }
                                body_cont += '</td>';
                                
                                body_cont += '<td class="w40">'+data[i].crt_dtms+'</td>';
                                body_cont += '<td class="w170">'+data[i].post_cat+'</td>';
                                body_cont += '<td class="tit" id="tit'+i+'">';
                                body_cont += '<a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx='+data[i].idx+'" class="chk_perm_view">'+data[i].post_subj;
                                body_cont += '<span class="uk-label hidden" id="post_summary'+i+'">'+data[i].post_summary+'</span>';
                                body_cont += '</a></td>';
                                body_cont += '<td class="w170">'+data[i].post_field+'</td>';
                                <?php if($is_adm_mod){ ?>
                                body_cont += '<td class="no">'+data[i].post_like+'</td>';
                                body_cont += '<td class="no">'+data[i].post_cmt_cnt+'</td>';
                                body_cont += '<td class="no">'+data[i].post_hit+'</td>';
                                <?php } ?>
                                body_cont += '</tr>';
                                
                            }
                            body_row.html(body_cont);
                            $('.uk-pagination').css('display','none');
                        },
                        error: function(data, status, err) {
                            alert('데이터를 불러오는데 실패했습니다.');
                            console.log(err);
                        },
                    });
                }
            });
            <?php
                if($post_cat_filter!='' || $post_field_filter!='') {
            ?>
                $(".btnOk").click();
            <?php
                }
            ?>
            
        }
        function handleChange (e) {
            console.log(e);
            
        }
        
    </script>
    <?php
    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>

<!-- 게시글 목록 :: 시작-->