<!DOCTYPE html>
<?php
include("inc/db.php");
session_start();
date_default_timezone_set('America/Denver');

if(empty($_SESSION['login_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./sblogin\">";
} else {

include("inc/header.php");
?>

<!-- Main Wrapper -->
<div id="wrapper">

<div id="contentloader" class="content animate-panel">
</div>

<!-- Right sidebar -->
<div id="right-sidebar" class="animated fadeInRight">
    <!-- myCart && User Settings Side Bar && previousOrderHistory -->
    <?php
        include("inc/sideBar/previousOrder.html");
        include("inc/sideBar/myCart.html");
        include("inc/sideBar/userSetting.html");
    ?>
</div>
</div>

<!-- included side navigation menu button -->
<?php
    include("inc/sideButton/sideButtonMenu.html");
?>
<!-- included modals -->
<?php
    include("inc/modals/terms.html");
    include("inc/modals/previousOrder.html");
    include("inc/modals/otherProduct.html");
    include("inc/modals/initialSelect.html");
    include("inc/modals/individualProduct.html");
    include("inc/modals/submitOrder.html");
?>
<!-- included modals -->
<?php
    include("inc/mainScript.html");
?>

</div>
</body>
</html>

<?php
}
?>