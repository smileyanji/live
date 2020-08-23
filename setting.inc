<?php
$_API = array
(

/**
 * apiDomain
 * API서버 도메인
 * 'http://' or 'https://' 부터 시작합니다.
 */
'apiDomain' => '###Input your api link here!###' ,
 
 /**
 * accesskeyId
 * accesskey ID
 */
'accesskeyId' => '###Input your api accesskey ID here!###' ,
 
 /**
 * accesskeySecret
 * accesskey 비번
 */
'accesskeySecret' =>  password_hash ('###Input your api accesskey secret here!###' , PASSWORD_DEFAULT) ,

/**
 * version
 * api 버전
 */
'version' => '###Input your api version here!###' ,

'folder' => array(
	'token' => '/authorization/' ,
	'channel' => '/channels/'
	)
) ;
