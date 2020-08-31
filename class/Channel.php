<?php
/**
 * Channel class
 *
 * @author zhoushiqi
 */
class Channel
{
	/**
	 * @var string accesskey ID
	 */
	private static $accesskeyId ;
	/**
	 * @var string accesskey 비번
	 */
	private static $accesskeySecret ;
	public $key ;
	private static $base ;
	private $countOvertime ;
	private static $token ;
	private static $channel ;

	//Connect api
	public function __construct ( $setting )
	{
		self::$accesskeyId = $setting['accesskeyId'] ;
		self::$accesskeySecret = $setting['accesskeySecret'] ;
		self::$base = $setting['apiDomain'] . $setting['version'] ;
		self::$token = $setting['folder']['token'] ;
		self::$channel = $setting['folder']['channel'] ;
		$this -> countOvertime = FALSE ;
		$return = self::curl ( self::$token , 'GET' ) ;
		$array = json_decode ( $return , true ) ;
		$this -> key = $array['Token'] ;
	}

	public function curl ( $url , $method , $type = NULL )
	{
		$url = self::$base . $url ;
		$curl = curl_init () ;
		curl_setopt ( $curl , CURLOPT_URL , $url ) ;
		curl_setopt ( $curl , CURLOPT_RETURNTRANSFER , true ) ;
		curl_setopt ( $curl , CURLOPT_BINARYTRANSFER , true ) ;
		curl_setopt ( $curl , CURLOPT_FOLLOWLOCATION , true ) ;
		if ( $method == 'POST' )
		{
			curl_setopt ( $curl , CURLOPT_POST , 1 ) ;
			curl_setopt ( $curl , CURLOPT_POSTFIELDS , $dataUse ) ;
		}
		else
			curl_setopt ( $curl , CURLOPT_CUSTOMREQUEST , $method ) ;
		curl_setopt ( $curl , CURLOPT_REFERER , $_SERVER['SERVER_NAME'] ) ;
		if ( ! $type )
		{
			curl_setopt ( $curl , CURLOPT_HTTPHEADER , array (
				'AccesskeyID:' . self::$accesskeyId ,
				'AccesskeySecret:' . self::$accesskeySecret
			) ) ;
		}
		else
		{
			curl_setopt ( $curl , CURLOPT_HTTPHEADER , array (
				"Authorization:{$this -> key}"
			) ) ;
		}
		return curl_exec ( $curl ) ;
	}

	public function channelList ()
	{
		$return = self::curl ( self::$channel , 'GET' , 'channels' ) ;
		$array = json_decode ( $return , true ) ;
		return $this -> returnMsg ( $array , __FUNCTION__ ) ;
	}

	public function channelDetail ( $id )
	{
		$return = self::curl ( self::$channel . $id , 'GET' , 'channels' ) ;
		$array = json_decode ( $return , true ) ;
		return $this -> returnMsg ( $array , __FUNCTION__ ) ;
	}

	public function returnMsg ( $response , $functionName , $param1 = '' , $param2 = '' )
	{
		if ( ! $response )
			return FALSE ;

		if ( ! isset ( $response['Result'] ) )
			return FALSE ;

		if ( $this -> overtime ( $response['Result'] ) )
		{
			$param = array () ;
			if ( $param1 )
				array_push ( $param , $param1 ) ;
			if ( $param2 )
				array_push ( $param , $param2 ) ;
			/**
			 * 세 토큰로 다시 function 호출하기
			 */
			return $this -> countOvertime ? NULL : call_user_func_array ( array ( $this , $functionName ) , $param ) ;
		}
		return $response ;
	}

	/**
	 *  토큰 유효시간 초과할때 다시요청 ( 한번만 )
	 * @param string $msg API return 메시지
	 * @return bool TRUE:다시요청 완료 ; FALSE:거절 ( 이미 다시요청했음 )
	 */
	public function overtime ( $msg )
	{
		if ( $msg == 'InvalidToken.Expired' )
		{
			$reqToken = json_decode ( $this -> __construct () ) ;
			$this -> countOvertime = TRUE ;
			return TRUE ;
		}
		else
		{
			$this -> countOvertime = FALSE ;
			return FALSE ;
		}
	}

}
