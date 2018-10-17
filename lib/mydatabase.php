<?php 

/**
 * 
 */
class Database
{

	public $host = DB_HOST;
	public $user = DB_USER;
	public $pass = DB_PASS;
	public $dbname = DB_NAME;

	public $link;
	public $error;
	
	function __construct()
	{
		$this->getConnection();
	}

	private function getConnection(){
		$this->link=new mysqli($this->host,$this->user,$this->pass,$this->dbname);

		if(!$this->link){
			$this->error="Connection fail....!".$this->link->connect_error;
			return false;
		}
	}

	public function getAllPost($query){
	    $result=mysqli_query($this->link,$query);
        return $result;
//	    if($result){
//	        return $result;
//        }else{
//	        return false;
//
//        }
    }

    public function getPopularPost($query){
        $result=mysqli_query($this->link,$query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getLatestPost($query){
        $result=mysqli_query($this->link,$query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getAllSubject($query){
        $result=mysqli_query($this->link,$query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getRequestedPost($query){
        $result=mysqli_query($this->link,$query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function updatePostCount($query){
        $result=mysqli_query($this->link,$query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getUsers($query){
        $result=mysqli_query($this->link,$query);
        return $result;
    }

}

 ?>