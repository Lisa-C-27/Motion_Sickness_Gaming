<?php
//    if($getrep['commthumbs'] <= 50) {
//        echo 'Newbie';
//    } else if($getrep['commthumbs'] > 50 && $getrep['commthumbs'] <= 500) {
//        echo 'Partially Sick Member';
//    } else if($getrep['commthumbs'] > 500) {
//        echo 'Fully Sick Member';
//    }
    if($getrep['acctStatus'] == 3) {
        echo 'Admin';
    } else if($getrep['commRep'] <= 50) {
        echo 'Newbie';
    } else if($getrep['commRep'] > 50 && $getrep['commRep'] <= 500) {
        echo 'Partially Sick Member';
    } else if($getrep['commRep'] > 500) {
        echo 'Fully Sick Member';
    }
?>