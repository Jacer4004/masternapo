<?php
###clase pararecursividad en las áreas
class Tree
{
	private $_dbh;
	private $_elements = array();

	public function __construct()
	{
		try{
			$this->_dbh = new PDO("mysql:host=localhost;dbname=gadnapo", "root", "");
			$this->_dbh->exec("SET CHARACTER SET utf8");
	        $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	    } 
	    catch (PDOException $e) 
	    {
            print "Error!: " . $e->getMessage();
            die();
        }
	}

	public function get()
	{
		$query = $this->_dbh->prepare("SELECT * FROM gad_accesos");
		$query->execute();
		$this->_elements["masters"] = $this->_elements["childrens"] = array();

		if($query->rowCount() > 0)
		{
			foreach($query->fetchAll() as $element)
			{
				if($element["id_id_acceso"] == 0)
				{
					array_push($this->_elements["masters"], $element);
				}
				else
				{
					array_push($this->_elements["childrens"], $element);
				}
			}
		}
		return $this->_elements;
	}

	public static function nested($rows = array(), $parent_id = 0)
	{
		$html = "";
		if(!empty($rows))
		{
			$html.="<ul>";
			foreach($rows as $row)
			{
				if($row["id_id_acceso"] == $parent_id)
				{
					$html.="<li style='margin:5px 0px'>";
					$html.="<span><i class=''></i></span>";
					$html.="<a href='#' data-status='{$row["hijos"]}' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>";
					if($row["hijos"] == 1)
					{
						$html.="<span class=''></span>".$row['acc_nombre']."</a>";
					}
					else
					{
						$html.="<span class=''></span>".$row['acc_nombre']."</a>";
					}
					$html.=self::nested($rows, $row["id_acceso"]);
					$html.="</li>";
				}
			}
			$html.="</ul>";
		}
		return $html;
	}
}