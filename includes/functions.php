<?php

class User
{
    public $Usr_ID;
    public $Usr_Username;
    public $Usr_Password;
    public $Usr_Lastname;
    public $Usr_Firstname;
    public $Usr_Email;
    public $Usr_Phone;
    public $Usr_Mobile;
    public $Usr_Role_Admin;
    public $Usr_Role_Editor;
    public $Usr_Status;
    public $Usr_Prefs;

    public $User_List = array();

   
    function GetLoggedUser()
    {
        $LoggedID = 0;
       
        if (isset ($_SESSION['LoggedUserID']))
            $LoggedID = $_SESSION['LoggedUserID'];
        else
            $LoggedID = 0;
            
        return $LoggedID;
    }

    function IsAdmin($ID)
    {
        
        $ID = mysql_real_escape_string($ID);
        $sql = "SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['usr_id'];
                $this->Usr_Role_Admin = $row['usr_admin'];
            }
        }
        return $this->Usr_Role_Admin;
    }

    function IsEditor($ID)
    {
        
        $ID = mysql_real_escape_string($ID);
        $sql = "SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['Usr_ID'];
                $this->Usr_Role_Editor = $row['Usr_Role_Editor'];
            }
        }
        return $this->Usr_Role_Editor;
    }

    function Get_User ($ID)
    {
        $ID = mysql_real_escape_string($ID);
        $sql="SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            $this->User_List = array();
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['Usr_ID'];
                $this->Usr_Username = $row['Usr_Username'];
                $this->Usr_Password = $row['Usr_Password'];
                $this->Usr_Lastname = $row['Usr_Lastname'];
                $this->Usr_Firstname = $row['Usr_Firstname'];
                $this->Usr_Email = $row['Usr_Email'];
                $this->Usr_Phone = $row['Usr_Phone'];
                $this->Usr_Mobile = $row['Usr_Mobile'];
                $this->Usr_Role_Admin = $row['Usr_Role_Admin'];
                $this->Usr_Role_Editor = $row['Usr_Role_Editor'];
                $this->Usr_Status = $row['Usr_Status'];
                $this->User_List[]=$row;
            }
        }
    }
}

?>

