<?php
//This page is not complete. Need to add the following:
//  Content and styling
    session_start();
    include 'header.php';
    include 'nav.php';
?>

<div class="container about">
    <h1>Contact</h1>
    <p>If you have any suggestions to improve the site or have experienced any bugs, please fill out the form below.</p>
    <p>I will endeavour to fix any bugs as soon as possible and email you once fixed.</p>
    <div class="form-container">
        <form class="pure-form pure-form-stacked">
            <fieldset>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"/>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"/>
                <label for="details">Details:</label>
                <textarea id="details" name="details" rows="8"></textarea>
                <button type="submit" class="pure-button pure-button-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
<?php
    include 'footer.php';
?>