<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
        <a href="listproducts.php">Κατάλογος προϊόντων</a>
        <p></p>
        <h1>Νέο προϊόν</h1>
        <form name="edit" action="http://localhost:61793/api.php?action=set_new_product" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Προϊόν:</td>
                    <td>
                        <input type="text" name="prod_name" value="" size="20"></input>
                    </td>
                </tr>
                <tr>
                    <td>Περιγραφή: </td>
                    <td>
                        <input type="text" name="prod_info" value="" size="40"></input>
                    </td>
                </tr>
                <tr>
                    <td>Τιμή: </td>
                    <td>
                        <input type="number" name="prod_price" value="0" min="0" step="any"></input>
                    </td>
                </tr>
                <tr>
                    <td>Έκπτωση: </td>
                    <td>
                        <input type="number" name="prod_discount" value="0" min="0" step="any"></input>
                    </td>
                </tr>
                <tr>
                    <td>Ποσότητα: </td>
                    <td>
                        <input type="number" name="prod_quantity" value="0" min="0" step="any"></input>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="Submit" value="Submit"></input>  <input type="reset" name="Reset" value="Reset"></input>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
