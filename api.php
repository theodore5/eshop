<?php
    ob_start();
    include "includes/config.php";
    include "includes/functions.php";

function set_new_product()
{
    // SAMPLE data:
    // http://localhost:61793/REST_Client.php?action=set_new_product&prod_name=Prod 01&prod_info=Coffee maker, extremely eay to use&prod_price=18,2&prod_discount=32,80&prod_quantity=34
    $prod_name =  mysql_escape_string($_POST['prod_name']);
    $prod_info = mysql_escape_string($_POST['prod_info']);
    $prod_price = $_POST['prod_price'];
    $prod_discount = $_POST['prod_discount'];
    $prod_quantity = $_POST['prod_quantity'];
    $strSQL = "INSERT INTO products (prod_name, prod_info, prod_price, prod_discount, prod_quantity) VALUES
                ('$prod_name', '$prod_info', $prod_price, $prod_discount, $prod_quantity)";
    $result = mysql_query($strSQL);
    if ($result)
        return ("Το προϊόν δημιουργήθηκε στη βάση δεδομένων.");
    else
        return (mysql_error());
}

function in_basket()
{
    $prod_info = array();

    $prod_id =  mysql_escape_string($_POST['in_basket_prod_id']);
    $user_id = mysql_escape_string($_POST['in_basket_user_id']);
    $prod_quantity = $_POST['in_basket_quantity'];
    $strSQL = "INSERT INTO basket (prod_id, cust_id, quantity) VALUES ($prod_id, $user_id, $prod_quantity)";
    $result = mysql_query($strSQL);
 
    if ($result)
        return ("Το προϊόν προστέθηκε στο καλάθι.");
    else
        return (mysql_error());
}

function get_basket($uid)
{
    $strSQL = "SELECT products.prod_name, basket.quantity, products.prod_discount, products.prod_price 
            FROM basket INNER JOIN products ON basket.prod_id = products.prod_id 
            WHERE basket.cust_id=$uid";
    $result = mysql_query($strSQL) or die('Query failed. ' . mysql_error());
    while ($row = mysql_fetch_array($result))
    {
        $line_value = $row['prod_price'] * $row['prod_quantity'] * ((100 - $row['prod_discount'])/100);
        $prod_info[] = array("prod_name" => $row['prod_name'], "prod_price" => $row['prod_price'], "prod_discount" => $row['prod_discount'], "prod_quantity" => $row['quantity'], "line_value" => $line_value);
    }
    return $prod_info;
}

function get_products()
{
    $prod_info = array();
    $sql = "SELECT * FROM products ORDER BY prod_name";
    $result = mysql_query($sql) or die('Query failed. ' . mysql_error());
    while ($row = mysql_fetch_array($result))
    {
        $prod_info[] = array("id" => $row['prod_id'], "prod_name" => $row['prod_name'], "prod_info" => $row['prod_info'], "prod_price" => $row['prod_price'], "prod_discount" => $row['prod_discount'], "prod_quantity" => $row['prod_quantity']);
    }

  return $prod_info;
}


// *******************************************************************************
//
// Function: do_login();
// Δέχεται δεδομένα POST και επικυρώνει το χρήστη
//
// *******************************************************************************
function do_login()
{
    session_start();

    $username = mysql_escape_string($_POST['username']);
    $password = mysql_escape_string($_POST['password']);

    $LoggedUser = new User();
    //if ($LoggedUser->login($username, $password) == TRUE)

        //$pass = md5($pass);
        $sql = "SELECT * FROM users WHERE Usr_Username = '$username' AND Usr_Password = '$password'";
        $result = mysql_query($sql) or die('Query failed. ' . mysql_error());
        if (mysql_num_rows($result) == 1) 
        {
            $row = mysql_fetch_array($result);
            $_SESSION['authorized'] = true;
            $_SESSION['LoggedUserID'] = $row['usr_id'];
            $_SESSION['LoggedName'] = $row['usr_username'];

            $Logged_ID = $LoggedUser->GetLoggedUser();
            echo "Logged id ".$Logged_ID;
            $AdminAccess = $LoggedUser->IsAdmin($Logged_ID);
            echo " Is admin ".$AdminAccess;
            if ($AdminAccess == 1)
                header("Location: http://localhost:61793/newproduct.php");
            else
                header("Location: http://localhost:61793/listproducts.php");
            return TRUE;
        } 
        else 
        {
            $_SESSION['error'] = 'Wrong username or password';
            header("Location: message.php?msgid=1");
            return FALSE;
        }
}

$possible_url = array("get_app_list", "get_app", "set_new_product", "do_login", "get_products", "in_basket", "get_basket");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
    switch ($_GET["action"])
    {
        case "get_app_list":
            $value = get_app_list();
        break;
        case "get_app":
            if (isset($_GET["id"]))
                $value = get_app_by_id($_GET["id"]);
            else
                $value = "Missing argument";
        break;
        case "set_new_product":
    //        if (isset($_GET["prod_name"]) && isset($_GET["prod_info"]) && isset($_GET["prod_price"]) && isset($_GET["prod_discount"]) && isset($_GET["prod_quantity"]))
    //            $value = set_new_product($_GET["prod_name"], $_GET["prod_info"], $_GET["prod_price"], $_GET["prod_discount"], $_GET["prod_quantity"]);
            $value = set_new_product();
            echo "RESULT: ".$value;
        break;
        case "do_login":
            $value = do_login();
            echo "RESULT: ".$value;
        break;
        case "get_products":
            $value = get_products();
        break;    
        case "in_basket":
            $value = in_basket();
        break;     
        case "get_basket":
        if (isset($_GET["uid"]))
            $value = get_basket($_GET["uid"]);
        break;                   
        }
}

//return JSON array
exit(json_encode($value));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
