<?php
namespace Ladecadanse;

use Ladecadanse\Element;

class Description extends Element 
{

	function __construct()
	{
		$this->table = 'descriptionlieu';
		$this->nom = 'description';
	}

	function loadByType($type)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE id".ucfirst($this->table)."=".$this->id." AND type='".mysql_real_escape_string($type)."'";
		//echo $sql;
		$res = $this->connector->query($sql);
		$this->valeurs = $this->connector->fetchAssoc($res);
	}
}