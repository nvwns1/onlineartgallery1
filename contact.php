<?php include "header.php"; ?>

<main>
    <section class="hero">
    <div class="hero-text">
    <h2>Contact Us</h2>
	<p>Please fill out the form below to contact us:</p>
        
    </div>
    </section>

    <section>

	<form action="process-form.php" method="post">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br>

		<label for="message">Message:</label>
		<textarea id="message" name="message" rows="5" cols="30" required></textarea><br>

		<input type="submit" value="Submit">
	</form>

    </section>
</main>


<?php include "footer.php"; ?>
