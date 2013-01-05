<?php
/******************************************************************
	ABOUT THE AUTHOR
	CREATED BY: Tan, Angelito S.
	EMAIL ADDRESS: angelito.tan23@yahoo.com
	
	OPEN SOURCE FRAMEWORK
	PHP VERSION: Written in PHP 5.3.5
	
	PURPOSE: To help other's who want to create there own framework
	
	YEAR CREATION: 2011
*******************************************************************/

Class Pagination{
	var $base_url;
	var $per_page;
	var $total_page;
	var $display;
	var $current_page;
	
	public function set_up( $base_url, $display = 5,  $per_page = 0, $total_page = 0, $current_page = 1 ){
		$this->base_url = $base_url;
		$this->per_page = $per_page;
		$this->total_page = $total_page;
		$this->display = $display;
		$this->current_page = $current_page;
	}
	
	public function create_anchor_reload(){
		$count = 0;
		$anchor='';
		$d=0;
		$e=0;
		$f=0;
		$i=0;
		$z=0;
		$y=0;
		$total_pagination = ceil($this->total_page / $this->per_page);
		$z = $this->per_page;	
		if ( $total_pagination > $this->display )
		{
			for ( $page = 1; $page <=  $total_pagination; $page ++ )
			{
				$d = $this->current_page % $this->display;
				$e = $this->current_page;
				for($loop=0; $loop <= $this->display; $loop ++){
					if ($d == 0){
						$f = $e - $this->display;
					}elseif ($d == $loop){
						$f = $e - $loop;
					}
				}

				if ($page > $f)
				{
					$count+=1;
					if ($count <= $this->display)
					{
						if ( $page == $this->current_page )
						{
							$anchor .= " [<b>$page</b>] ";
						}else
						{
							$i = $page * $this->per_page;
							$anchor .= " <a href = $this->base_url/$i>$page</a> ";
						}
						$i += $this->per_page;
						$y += $this->per_page;
						$z = ((($i - $y) / $this->per_page) - $this->display) * $this->per_page;
						if($z < 0){
							$z = $this->per_page;
						}
					}
				}
			}
		}else{
			for ( $page = 1; $page <= $total_pagination; $page ++ ) 
			{
				$i = $page * $this->per_page;
				$anchor .= " <a href = $this->base_url/$i>$page</a> ";
			}
			$i += $this->per_page;	
		}
		$anchor .= " <a href = $this->base_url/$i>>></a> ";
		return " <a href = $this->base_url/$z><<</a> ".$anchor;
	}
	
	public function create_anchor_ajax(){
	
	}
}
?>