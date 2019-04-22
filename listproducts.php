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
        <a href="newproduct.php">Νέο προϊόν</a>      <a href="listbasket.php">Νέο προϊόν</a>
        <p></p>
        <h1>Διαθέσιμα προϊόντα</h1>
        <?php
        $LoggedUser = new User();
        $in_basket_user_id = $LoggedUser->GetLoggedUser();

        $prod_info = file_get_contents('http://localhost:61793/api.php?action=get_products');
        $array_info = json_decode($prod_info, true);
        echo "<table style=\"width: 80%;\">";
        echo "<tr>";
        echo "<td style=\"padding: 12px;\"><strong>Κωδικός</td><td style=\"padding: 12px;\"><strong>Ονομασία</td><td style=\"padding: 12px;\"><strong>Πληροφορίες</td><td style=\"padding: 12px;\"><strong>Τιμή</td><td style=\"padding: 12px;\"><strong>Έκπτωση</td><td style=\"padding: 12px;\"><strong>Διαθέσιμα</td><td style=\"padding: 12px;\"><strong>Ποσότητα αγοράς</td>";
        echo "</tr>";
        foreach ($array_info as $key => $value) 
        { 
            echo "<tr>";
            echo "<form name=\"inbasket\" action=\"http://localhost:61793/api.php?action=in_basket\" method=\"POST\" enctype=\"multipart/form-data\">";
            foreach ($value as $k => $v) 
            {
                echo "<td style=\"padding: 12px;\">";
                if (strcmp ($k, "id")==0)
                    $in_basket_id = $v;
                echo $v; 
                echo "</td>";
            }

            echo "<td style=\"padding: 12px;\">";
            echo "<input type=\"number\" name=\"in_basket_quantity\" value=\"\" size=\"3\" min=\"0\" step=\"any\"></input>"; 
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"in_basket_prod_id\" value=\"$in_basket_id\" ></input>"; 
            echo "<input type=\"text\" name=\"in_basket_user_id\" value=\"$in_basket_user_id\" ></input>"; 
            echo "<input type=\"submit\" name=\"Submit\" value=\"Στο καλάθι\"></input>";
            echo "</td>";
            
            echo "</form>";
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
