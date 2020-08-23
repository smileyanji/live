<?php
define ( 'INC' , __DIR__ ) ;
define ( 'SAMPLE' , dirname ( __DIR__ ) ) ;
define ( 'PROJECT' , dirname ( SAMPLE ) ) ;
define ( 'CLASSPATH' , PROJECT . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR ) ; // 클래스 폴더

date_default_timezone_set ( 'Asia/Seoul' ) ;
putenv ( 'LC_ALL=ko_KR.utf8' ) ;
setlocale ( LC_ALL , 'ko_KR.utf8' ) ;

include_once PROJECT . '/setting.inc' ;
include_once INC . '/header.inc' ;
include_once CLASSPATH . 'Channel.php' ;

$Channel = new Channel ( $_API ) ;
