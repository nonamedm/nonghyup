<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| T R E E
| -------------------------------------------------------------------
| id
| tit
| typ
| func
| mode
| cat
| tbl
| fld
| skin
| perm
| mthd
| lng_mode_yn
| file
| edtr
| sub
*/

log_message("info", ":::::::::: :::::::::: :::::::::: 트리 ");

// ***** nav
$config['svc_tree'] = [
    [
        'id'	        => 'home'
        ,'tit'          => ['홈','Home']
        ,'typ'         => 'cont'
        ,'fnc'         => 'flex'
        ,'mod'         => ''
        ,'cat'          => ''
        ,'tbl'	        => ''
        ,'fld'	        => ''
        ,'skin'         => ''
        ,'perm'         => ''
        ,'status'       => ''
        ,'lng_mode_yn'  => ''
        ,'visible_yn'   => ''
        ,'edtr'         => ''
        ,'file'         => ''
        ,'sub'	        => [

            [
                'id'	        => 'trends'
                ,'idx'	        => 1
                ,'tit'	        => ['금융규제동향','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'pr'
                        ,'tit'	        => ['보도자료','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_pr'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'pr'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'lawmaking'
                        ,'tit'	        => ['입법동향','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_lawmaking'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'lawmaking'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'news'
                        ,'tit'	        => ['NEWS','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_news'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'news'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'current'
                        ,'tit'	        => ['현행법령','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => [0=>['id'=>'common', 'tit'=>'공통관련법규'], 1=>['id'=>'bank', 'tit'=>'은행관련법규'],2=>['id'=>'investment', 'tit'=>'금융투자관련법규'],3=>['id'=>'microfinance', 'tit'=>'비은행관련법규']]
                        ,'tbl'	        => 'ct_current'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'current'
                        ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'personnelTrends'
                        ,'tit'	        => ['기관동향','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_personnelTrends'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'news'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                ]
            ]
            ,[
                'id'	        => 'research'
                ,'idx'	        => 2
                ,'tit'	        => ['기관연구자료','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'labdata'
                        ,'tit'	        => ['연구자료','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_labdata'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'data'
                        ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'edudata'
                        ,'tit'	        => ['세미나자료','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_edudata'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'data'
                        ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                ]
            ]
            ,[
                'id'	        => 'brief'
                ,'idx'	        => 0
                ,'tit'	        => ['Legal Brief','']
                ,'typ'          => 'cont'
                ,'fnc'          => 'bbs'
                ,'mod'          => 'lists'
                ,'cat'          => ''
                ,'tbl'	        => 'ct_brief'
                ,'fld'	        => 'basic'
                ,'skin'         => 'brief'
                ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => 1
                ,'edtr'         => 'Y'
                ,'sub'	        => []
            ]
            ,[
                'id'	        => 'workdata'
                ,'idx'	        => 6
                ,'tit'	        => ['업무자료','']
                ,'typ'         => 'label'
                ,'fnc'         => ''
                ,'mod'         => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'intnlctrl'
                        ,'tit'	        => ['내부통제','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_intnlctrl'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'finnaccexp'
                        ,'tit'	        => ['금융사고사례','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_finnaccexp'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'prevmnlaun1'
                        ,'tit'	        => ['자금세탁방지','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_prevmnlaun1'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'prevmnlaun2'
                        ,'tit'	        => ['자금세탁방지2','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_prevmnlaun2'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                ]
            ]
            ,[
                'id'	        => 'voter'
                ,'idx'	        => 3
                ,'tit'	        => ['유권해석·판례','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'translate'
                        ,'tit'	        => ['법령해석','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_translate'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'trans'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'noaction'
                        ,'tit'	        => ['비조치의견서','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_noaction'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'trans'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'sanctions'
                        ,'tit'	        => ['금융제재사례','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_sanctions'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'sanctions'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'precedent'
                        ,'tit'	        => ['금융판례','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_precedent'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'precedent'
                        ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 2
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]                    
                ]
            ]
            ,[
                'id'	        => 'overview'
                ,'idx'	        => 5
                ,'tit'	        => ['규제대응지원','']
                ,'typ'         => 'label'
                ,'fnc'         => ''
                ,'mod'         => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'greetings'
                        ,'tit'	        => ['준법감시인 인사말','']
                        ,'typ'         => 'cont'
                        ,'fnc'         => 'pg'
                        ,'mod'         => ''
                        ,'cat'          => ''
                        ,'tbl'	        => ''
                        ,'fld'	        => ''
                        ,'skin'         => ''
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'about'
                        ,'tit'	        => ['포털소개','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'pg'
                        ,'mod'          => ''
                        ,'cat'          => ''
                        ,'tbl'	        => ''
                        ,'fld'	        => ''
                        ,'skin'         => ''
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    /*,[ --23년 하반기 2차개선 요청사항
                        'id'	        => 'improvement'
                        ,'tit'	        => ['Quick Service','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'write'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_improvement'
                        ,'fld'	        => 'qna'
                        ,'skin'         => 'qna'
                        ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ] */
                    ,[
                        'id'	        => 'qna'
                        ,'tit'	        => ['Q&A','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'write'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_qna'
                        ,'fld'	        => 'qna'
                        ,'skin'         => 'qna'
                        ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'reply'=>1, 'modify'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'relateSite'
                        ,'tit'	        => ['유용한 사이트','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_relateSite'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'relateSite'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>0, 'modify'=>5, 'delete'=>5, 'dnload'=>0]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => [
                            [
                                'id'	        => 'improvement'
                                ,'tit'	        => ['등록테스트','']
                                ,'typ'          => 'cont'
                                ,'fnc'          => 'bbs'
                                ,'mod'          => 'write'
                                ,'cat'          => ''
                                ,'tbl'	        => 'ct_improvement'
                                ,'fld'	        => 'qna'
                                ,'skin'         => 'qna'
                                ,'perm'         => ['lists'=>10, 'view'=>10, 'write'=>2, 'reply'=>10, 'modify'=>10, 'delete'=>10, 'dnload'=>1]
                                ,'status'       => ''
                                ,'lng_mode_yn'  => ''
                                ,'visible_yn'   => ''
                                ,'file'         => ''
                                ,'edtr'         => 'Y'
                                ,'sub'	        => []
                            ]
                    ]
                    ]

                ]
            ]
            ,[
                'id'	        => 'search'
                ,'tit'	        => ['검색결과','Search']
                ,'typ'          => 'cont'
                ,'fnc'          => 'flex'
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => 'N'
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'          => []
            ]
            ,[
                'id'	        => 'mypage'
                ,'tit'	        => ['마이페이지','Search']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => 'N'
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'          => [
                    [
                        'id'	        => 'info'
                        ,'tit'	        => ['회원정보','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'flex'
                        ,'mod'          => ''
                        ,'cat'          => ''
                        ,'tbl'	        => ''
                        ,'fld'	        => ''
                        ,'skin'         => 'member'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => 'N'
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    /*,[ --23년 하반기 2차개선 요청사항
                        'id'	        => 'myimprovement'
                        ,'tit'	        => ['나의 Quick service','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_improvement'
                        ,'fld'	        => 'qna'
                        ,'skin'         => 'qna'
                        ,'perm'         => ['lists'=>2, 'view'=>2, 'write'=>5, 'reply'=>5, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => 'N'
                        ,'file'         => ''
                        ,'edtr'         => 'y'
                        ,'sub'	        => []
                    ]*/
                    ,[
                        'id'	        => 'myqna'
                        ,'tit'	        => ['나의 Q&A','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_qna'
                        ,'fld'	        => 'qna'
                        ,'skin'         => 'qna'
                        ,'perm'         => ['lists'=>2, 'view'=>2, 'write'=>5, 'reply'=>5, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => 'N'
                        ,'file'         => ''
                        ,'edtr'         => 'y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'withdrawal'
                        ,'tit'	        => ['회원탈퇴','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'flex'
                        ,'mod'          => ''
                        ,'cat'          => ''
                        ,'tbl'	        => ''
                        ,'fld'	        => ''
                        ,'skin'         => 'member'
                        ,'perm'         => ''
                        ,'status'       => 'ready'
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => 'N'
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                ]
            ]
        ]
    ]
];



// ***** adm
$config['adm_tree'] = [
    [
        'id'	        => 'dashboard'
        ,'tit'	        => ['관리자 대시보드','Dashboard']
        ,'typ'          => 'label'
        ,'fnc'          => ''
        ,'mod'          => ''
        ,'cat'          => ''
        ,'tbl'	        => ''
        ,'fld'	        => ''
        ,'skin'         => ''
        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>5]
        ,'status'       => ''
        ,'lng_mode_yn'  => ''
        ,'visible_yn'   => ''
        ,'file'         => ''
        ,'edtr'         => ''
        ,'sub'	        => [
            [
                'id'	        => 'member'
                ,'tit'	        => ['회원관리','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ['lists'=>8, 'view'=>8, 'write'=>10, 'reply'=>10, 'modify'=>10, 'delete'=>10, 'dnload'=>10]
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'usr'
                        ,'tit'	        => ['회원관리','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_usr'
                        ,'fld'	        => 'usr'
                        ,'skin'         => 'member'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'dormant'
                        ,'tit'	        => ['휴면회원','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_usr'
                        ,'fld'	        => 'usr'
                        ,'skin'         => 'member'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'accessDeny'
                        ,'tit'	        => ['접근제한','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_usr'
                        ,'fld'	        => 'usr'
                        ,'skin'         => 'member'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                ]
            ]
            ,[
                'id'	        => 'content'
                ,'tit'	        => ['컨텐츠관리','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'pr'
                        ,'tit'	        => ['보도자료','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_pr'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'pr'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'lawmaking'
                        ,'tit'	        => ['입법동향','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_lawmaking'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'lawmaking'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]                   
                    ,[
                        'id'	        => 'news'
                        ,'tit'	        => ['NEWS','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_news'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'news'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 0
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'current'
                        ,'tit'	        => ['현행법령','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_current'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'current'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'personnelTrends'
                        ,'tit'	        => ['기관동향','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_personnelTrends'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'news'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'labdata'
                        ,'tit'	        => ['연구자료','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_labdata'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'data'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'edudata'
                        ,'tit'	        => ['세미나자료','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_edudata'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'data'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'brief'
                        ,'tit'	        => ['리걸브리프','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_brief'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'brief'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'intnlctrl'
                        ,'tit'	        => ['내부통제','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_intnlctrl'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>0, 'delete'=>5, 'dnload'=>0]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'modify'=>1, 'reply'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'finnaccexp'
                        ,'tit'	        => ['금융사고사례','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_finnaccexp'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>0, 'delete'=>5, 'dnload'=>0]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'modify'=>1, 'reply'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ] 
                    ,[
                        'id'	        => 'translate'
                        ,'tit'	        => ['법령해석','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_translate'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'trans'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'noaction'
                        ,'tit'	        => ['비조치의견서','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_noaction'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'trans'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'sanctions'
                        ,'tit'	        => ['금융제재사례','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_sanctions'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'sanctions'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'precedent'
                        ,'tit'	        => ['금융판례','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_precedent'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'precedent'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'relateSite'
                        ,'tit'	        => ['유용한 사이트','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_relateSite'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'relateSite'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>0, 'delete'=>5, 'dnload'=>0]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'prevmnlaun1'
                        ,'tit'	        => ['국내동향 & 주요이슈','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_prevmnlaun1'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>0, 'delete'=>5, 'dnload'=>0]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'modify'=>1, 'reply'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'prevmnlaun2'
                        ,'tit'	        => ['해외동향 & Sanctions','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_prevmnlaun2'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'workdata'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>0, 'delete'=>5, 'dnload'=>0]
                        // ,'perm'         => ['lists'=>1, 'view'=>1, 'write'=>1, 'modify'=>1, 'reply'=>1, 'delete'=>1, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 4
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                ]
            ]
            ,[
                'id'	        => 'query'
                ,'tit'	        => ['문의관리','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    /*[ --23년 하반기 2차개선 요청사항
                        'id'	        => 'improvement'
                        ,'tit'	        => ['Quick Service','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_improvement'
                        ,'fld'	        => 'qna'
                        ,'skin'         => 'qna'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ] */
                    [
                        'id'	        => 'qna'
                        ,'tit'	        => ['Q&A','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_qna'
                        ,'fld'	        => 'qna'
                        ,'skin'         => 'qna'
                        ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'reply'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                ]
            ]
            ,[
                'id'	        => 'site'
                ,'tit'	        => ['사이트관리','']
                ,'typ'          => 'label'
                ,'fnc'          => ''
                ,'mod'          => ''
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => [
                    [
                        'id'	        => 'agree'
                        ,'tit'	        => ['약관관리','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_agree'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'agree'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'keyword'
                        ,'tit'	        => ['키워드관리','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_keyword'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'keyword'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => ''
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'popup'
                        ,'tit'	        => ['팝업관리','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_popup'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'popup'
                        ,'perm'         => ''
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => ''
                        ,'sub'	        => []
                    ]
                    ,[
                        'id'	        => 'sanctions2'
                        ,'tit'	        => ['금융제재사례(개발중)','']
                        ,'typ'          => 'cont'
                        ,'fnc'          => 'bbs'
                        ,'mod'          => 'lists'
                        ,'cat'          => ''
                        ,'tbl'	        => 'ct_sanctions'
                        ,'fld'	        => 'basic'
                        ,'skin'         => 'sanctions2'
                        ,'perm'         => ['lists'=>1, 'view'=>2, 'write'=>5, 'reply'=>10, 'modify'=>5, 'delete'=>5, 'dnload'=>1]
                        ,'status'       => ''
                        ,'lng_mode_yn'  => ''
                        ,'visible_yn'   => ''
                        ,'file'         => 1
                        ,'edtr'         => 'Y'
                        ,'sub'	        => []
                    ]
                ]
            ]
            /*,[
                'id'	        => 'usr'
                ,'tit'	        => ['회원관리','Usr Jury Member']
                ,'typ'         => ''
                ,'fnc'         => 'bbs'
                ,'mod'         => 'lists'
                ,'cat'          => ''
                ,'tbl'	        => 'ct_usr'
                ,'fld'	        => 'usr'
                ,'skin'         => 'reg'
                ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>10, 'modify'=>10, 'delete'=>5, 'dnload'=>5]
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => ''
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => []
            ]*/
            /*,[
                'id'	        => 'download'
                ,'tit'	        => ['다운로드 파일관리','Download']
                ,'typ'         => ''
                ,'fnc'         => 'bbs'
                ,'mod'         => 'lists'
                ,'cat'          => ''
                ,'tbl'	        => 'ct_dnload'
                ,'fld'	        => 'dnload'
                ,'skin'         => 'dnload'
                ,'perm'         => ['lists'=>5, 'view'=>5, 'write'=>5, 'modify'=>5, 'delete'=>5, 'dnload'=>5]
                ,'status'       => 'ready'
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => 'N'
                ,'file'         => 1
                ,'edtr'         => ''
                ,'sub'	        => []
            ]*/
            /*,[
                'id'	        => 'excel_dnload'
                ,'tit'	        => ['엑셀다운로드','Excel Download']
                ,'typ'         => 'proc'
                ,'fnc'         => ''
                ,'mod'         => 'excel_dnload'
                ,'cat'          => ''
                ,'tbl'	        => ''
                ,'fld'	        => ''
                ,'skin'         => ''
                ,'perm'         => ''
                ,'status'       => ''
                ,'lng_mode_yn'  => ''
                ,'visible_yn'   => 'N'
                ,'file'         => ''
                ,'edtr'         => ''
                ,'sub'	        => []
            ]*/
        ]
    ]
];



// ***** AUTH
$config['auth_tree'] = [
    [
        'id'	        => 'auth'
        ,'tit'	        => ['인증','Member']
        ,'typ'         => 'label'
        ,'fnc'         => 'auth'
        ,'mod'         => ''
        ,'cat'          => ''
        ,'tbl'	        => 'ct_usr'
        ,'fld'	        => 'usr'
        ,'skin'         => 'auth'
        ,'perm'         => ''
        ,'status'       => ''
        ,'lng_mode_yn'  => ''
        ,'visible_yn'   => ''
        ,'file'         => ''
        ,'edtr'         => ''
        ,'sub'	        => [
        [
            'id'	        => 'join'
            ,'tit'	        => ['회원가입','Join']
            ,'typ'         => ''
            ,'fnc'         => 'flex'
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'joinForm'
            ,'tit'	        => ['회원가입폼','Join']
            ,'typ'         => ''
            ,'fnc'         => 'flex'
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'login'
            ,'tit'	        => ['로그인','Login']
            ,'typ'         => ''
            ,'fnc'         => 'flex'
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'adm_login'
            ,'tit'	        => ['관리자로그인','Login']
            ,'typ'         => ''
            ,'fnc'         => 'flex'
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'signin'
            ,'tit'	        => ''
            ,'typ'         => 'proc'
            ,'fnc'         => ''
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'logout'
            ,'tit'	        => ''
            ,'typ'         => 'proc'
            ,'fnc'         => ''
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'signup'
            ,'tit'	        => ''
            ,'typ'         => 'proc'
            ,'fnc'         => ''
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'withdrawal'
            ,'tit'	        => ['회원탈퇴','Withdrawal']
            ,'typ'         => 'proc'
            ,'fnc'         => ''
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'resetPw'
            ,'tit'	        => ['비밀번호변경','']
            ,'typ'         => ''
            ,'fnc'         => 'flex'
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'updatePw'
            ,'tit'	        => ''
            ,'typ'         => 'proc'
            ,'fnc'         => ''
            ,'mod'         => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
        ,[
            'id'	        => 'oauth'
            ,'tit'	        => ''
            ,'typ'          => 'proc'
            ,'fnc'          => ''
            ,'mod'          => ''
            ,'cat'          => ''
            ,'tbl'	        => ''
            ,'fld'	        => ''
            ,'skin'         => ''
            ,'perm'         => ''
            ,'status'       => ''
            ,'lng_mode_yn'  => ''
            ,'visible_yn'   => ''
            ,'file'         => ''
            ,'edtr'         => ''
            ,'sub'	        => ''
        ]
    ]
    ]
];
