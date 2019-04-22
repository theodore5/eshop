<?php
    include "includes/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
        <a href="newproduct.php">Νέο προϊόν</a>
        <p></p>
        <h1>Το καλάθι σας</h1>
        <?php
        $LoggedUser = new User();
        $LoggedID = $LoggedUser->GetLoggedUser();

        $prod_info = file_get_contents('http://localhost:61793/api.php?action=get_basket&uid='.$LoggedID);
        $array_info = json_decode($prod_info, true);
        echo "<table style=\"width: 80%;\">";
        echo "<tr>";
        echo "<td style=\"padding: 12px;\"><strong>Ονομασία</td><td style=\"padding: 12px;\"><strong>Τιμή</td><td style=\"padding: 12px;\"><strong>Έκπτωση</td><td style=\"padding: 12px;\"><strong>Διαθέσιμα</td><td style=\"padding: 12px;\"><strong>Ποσότητα αγοράς</td><td style=\"padding: 12px;\"><strong>Αξία</td>";
        echo "</tr>";
        foreach ($array_info as $key => $value) 
        { 
            echo "<tr>";
            foreach ($value as $k => $v) 
            {
                echo "<td style=\"padding: 12px;\">";
                echo $v; 
                echo "</td>";
            }
            echo "</tr>";
        }   
        echo "</table>";
        ?>
            <table>
                <tr>
                    <td></td>
                    <td>
                    </td>
                </tr>
            </table>
    </body>
</html>
