<?php
/******************************************************************
	ABOUT THE AUTHOR
	CREATED BY: Tan, Angelito S.
	EMAIL ADDRESS: angelito.tan23@yahoo.com
	
	OPEN SOURCE FRAMEWORK
	PHP VERSION: Written in PHP 5.3.5
	
	PURPOSE: To help other's who want to create there own framework
	
	YEAR CREATION: 2011
	Update Year: 2012
*******************************************************************/

Class _Db{
	private $user;
	private $pass;
	private $host;
	private $dbnm;
	private $cn;
	private $mysql_result;
	
	public function __construct()
	{
		$this->user = DB_USER;
		$this->pass = DB_PASS;
		$this->host = DB_HOST;
		$this->dbnm = DB_NAME;
		
	}

	public function connect(){
	//$dbConnection = mysql_pconnect( $myHostname, $myUsername, $myPassword  );
		$this->cn = mysql_connect( $this->host, $this->user, $this->pass ) or die('error connection');
		mysql_select_db ( $this->dbnm , $this->cn );
		//if ( !mysql_ping( $this->cn ) )
		//{
			//echo 'this';
		   //$this->cn = mysql_pconnect( $this->host, $this->user ) or die('error connection');
		   //mysql_select_db ( $this->dbname , $this->cn );
		//}
		//http://localhost:82/cool-schools/index.php?__profile/profile&id=-19%20UNION%20SELECT%201,2,3,4,5,6,7,8,9,10,11,12,13
	}
	
	public function query( $str , $assoc_type = 'assoc' ){
		$this->connect();
		if( strpos(strtolower($str), 'select') === 0 ){
		
		$this->mysql_result = mysql_query( $str );
			if ( $this->mysql_result && mysql_error() == '' ){
					switch ( $assoc_type )
					{
						case 'assoc':
							while( $row= mysql_fetch_assoc( $this->mysql_result ) ) {
								$result[] =  $row;
							}
						break;
						
						case 'fetch_row':
							$result = mysql_fetch_row( $this->mysql_result );
						break;
					}
			}else{
				return "error";
			}
		}else{
			mysql_query( $str );
		}
		if ( isset($result) ) return $result;
		
	}
	
	public function insert(){
	
	}
	
	public function update(){
	
	}
	
	public function delete(){
	
	}
	
	public function select(){
	
	}
}
?>