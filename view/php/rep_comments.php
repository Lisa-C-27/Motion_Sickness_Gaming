<?php
    if($getrep['commthumbs'] <= 50) {
        echo 'Newbie';
    } else if($getrep['commthumbs'] > 50 && $getrep['commthumbs'] <= 500) {
        echo 'Partially Sick Member';
    } else if($getrep['commthumbs'] > 500) {
        echo 'Fully Sick Member';
    }
?>