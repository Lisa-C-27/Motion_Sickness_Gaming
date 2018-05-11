Username/passwords:
    Admin user - 
        Username: Admin 
        Password: password
    General user -
        Username: Active
        Password: password
    Disable account - (to show that they cannot login)
        Username: Disabled
        Password: password

The mulitple UI interfaces via single page is done on individual_games.php

JavaScript components for form input:
I added a date picker for a birth date on the registration form, this does not update the database and I didn't add any validation for this field as I will be removing it after this assessment - I just wanted to show that I can add this for the assignment.
Also I added the text editor for the comments section on the individual games page. I have not removed my sanitisation but shown a comment that shows how it would display if the sanitisation was removed (On the 'Portal' game page). This text editor will also be removed after this assignment.

Please note that the thumbs up/down for comments/replies is not working yet as I haven't added the code for it yet, but the thumbs up/down for the game 'giving you motion sickness' is working. 

For the remembering of form value fields: I have added it to the 'add game' field, and also the 'remember me' checkbox upon login, remembers username and password (I will probably remove the remember password as it is currently not a secure method).

I have added a 'loader' for ajax and also for page loading.