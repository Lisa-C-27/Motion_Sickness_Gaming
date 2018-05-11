<div id="errorsection">

    <?php
        //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
        if (!isset($_SESSION['message'])){
            $_SESSION['message'] = "";
        }
        echo $_SESSION['message'];       
        unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
    ?>
</div>