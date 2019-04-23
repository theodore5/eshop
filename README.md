# eshop

1) User login (index.php - api.php): At index.php user enters username, password.
At api.php user is searched with these fields in database (do_login()).

2) Display of user's basket products (listbasket.php - api.php): Display of products that user
has chosen for purchasing. Call of get_basket() which is located at api.php.

3) Display of available products (listproducts.php - api.php): display of products tha user can 
add to basket. Call of get_products() of api.php. For product insertion to basket, in_basket() of api.php is called.

4) Creation of new product (newproduct.php - api.php): Insertion of product info to db. Call of set_new_product() of api.php.
