<?php
    session_start();
    include 'header.php';
    include 'nav.php';
?>

<div class="container page">
    <h1>Contact</h1>
    <p>If you have any suggestions to improve the site or have experienced any bugs, please fill out the form below.</p>
    <p>I will endeavour to fix any bugs as soon as possible.</p>
    <div class="form-container">
        <form class="pure-form pure-form-stacked" method="post" action="../../controller/contactform.php">
            <fieldset>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required/>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required/>
                <label for="details">Details:</label>
                <textarea id="details" name="details" rows="8" required></textarea>
                <button type="submit" class="pure-button pure-button-primary">Submit</button>
                <?php
                    include 'error_section.php';
                ?>
            </fieldset>
        </form>

    </div>
</div>

<?php
    include 'footer.php';
?>