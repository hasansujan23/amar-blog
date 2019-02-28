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

    public function getExecute($query){
        $result=mysqli_query($this->link,$query);
        $row=mysqli_affected_rows($this->link);
        if($row>0){
            return $row;
        }else{
            return 0;
        }
    }

    public function getDeltePost($id){
	    $query="select url from t_post where user_id='$id'";
        $result=mysqli_query($this->link,$query);
        $res=mysqli_num_rows($result);
        if($res>0){
            while ($row=mysqli_fetch_assoc($result)){
                unlink("../".$row['url']);
            }
        }
    }

    public function getDelteUserFile($id){
        $query="select profile_pic from t_user_details where user_id='$id'";
        $result=mysqli_query($this->link,$query);
        $res=mysqli_num_rows($result);
        if($res>0){
            while ($row=mysqli_fetch_assoc($result)){
                unlink("../".$row['profile_pic']);
            }
        }
    }

}

 ?>