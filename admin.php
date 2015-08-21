<?php

require_once( 'Eprotect.php' );

class Admin
{
	public $eprotect;
	function __construct()
	{
		$this->eprotect = new Eprotect( array( 'news' ) );
		$this->eprotect->protectMe( 'news', 'news' ); // first param is [your dynamic page name], second param [your dynamic page action]
	}
	public function news()
	{
		echo ' News List';
	}
}

?>