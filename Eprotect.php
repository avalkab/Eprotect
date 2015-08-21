<?php 

class Eprotect
{

	public $pages = array();
	public $login_type = 1;

	function __construct( Array $args = null )
	{
		$this->pages = $args;
	}

	public function validPages( $page = null )
	{
		return (in_array( $page, $this->pages ) != true) ? false : true;
	}

	public function validUsers()
	{
		return (isset($_SESSION['user']) != 1 || $_SESSION['user']['type_id'] != $this->login_type) ? false : true;
	}

	public function validUserPerms( $action = null )
	{
		return (in_array( $action,  $_SESSION['user']['permissions'] ) != true) ? false : true;
	}

	public function protectMe( $page = null, $action = null )
	{
		try
		{
			if ( $this->validPages($page) !== true )
			{
				throw new Exception( 'Invalid page' );
			}

			if ( $this->validUsers() !== true )
			{
				throw new Exception( 'Invalid user' );
			}

			if ( isset($action) )
			{
				if ( $this->validUserPerms($action) !== true )
				{
					throw new Exception( 'Invalid proccess' );
				}
			}

			return true;
		} 
		catch ( Exception $e )
		{
			echo $e->getMessage();
			exit;
		}
	}
}

?>