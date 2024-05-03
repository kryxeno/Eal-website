<?php

// https://www.youtube.com/watch?v=4q0gYjAVonI&t=248s        Basic PHP form info

// https://code.tutsplus.com/tutorials/create-a-contact-form-in-php--cms-32314        Data Validation/Sanitization setup

// https://www.youtube.com/watch?v=h5ghlfvU3S8          HTML Section based on input

if($_POST) {
    $name = "";
    $email = "";
    $subject = "";
    $message = "";
    $email_body = "<div>";
    $message_sent = false;
     
    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>".$name."</span>
                        </div>";
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }
     
    if(isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$subject."</span>
                        </div>";
    }
     
    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        $email_body .= "<div>
                           <label><b>Message:</b></label>
                           <div>".$message."</div>
                        </div>";
    }
     
    $recipient = "contact.ealesports@gmail.com";
     
    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
     
    if(mail($recipient, $subject, $email_body, $headers)) {
        $message_sent = true;
    }
     
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EAL Esports - Contact</title>
	<meta name="title" content="EAL Esports - Contact">
	<meta name="description" content="Get in touch with EAL if you have a business inquiry, or just want your questions answered.">
	<meta name="keywords" content="EAL, EAL Esports, EALESPORTS, competition, competitive, league, league of legends, lol, diamond, gold, diamond 1, gold 1, amateur, europe, european, EAL Season 3, EAL Season 4, EAL News, twitch, stream, edc, ">
	<meta name="robots" content="index, follow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="English">
    <meta property="og:url" content="https://ealesports.org/contactform.php">
	<meta property="og:type" content="website">
	<meta property="og:title" content="EAL Esports - Contact">
	<meta property="og:description" content="Get in touch with EAL if you have a business inquiry, or just want your questions answered.">
	<meta property="og:image" content="./Images/eal_og_image.jpg">
	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:domain" content="ealesports.org">
	<meta property="twitter:url" content="https://ealesports.org/contactform.php">
	<meta name="twitter:title" content="EAL Esports - Contact">
	<meta name="twitter:description" content="Get in touch with EAL if you have a business inquiry, or just want your questions answered.">
	<meta name="twitter:image" content="./Images/eal_og_image.jpg">
	<link rel="apple-touch-icon" sizes="180x180" href="./Images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./Images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./Images/favicon-16x16.png">
	<link rel="manifest" href="./Images/site.webmanifest">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.typekit.net/dwg0cmr.css">
</head>
<body>
<header>
		<nav>
            <!-- Input + label are for hamburger menu in mobile views -->
            <input type="checkbox" id="burger">
            <label for="burger"><img src="./Images/menu_icon.svg" alt="Menu Icon"></label>			
            <a href="./index.html">EAL</a>
            <a href="./index.html"><img src="./Images/eal_logo_white_graphic_big.svg" alt="EAL Esports Logo"></a>
			<ul>
				<li><a href="./index.html">Home</a></li>
				<li><a href="./news.html">News</a></li>
				<li><a href="./season3.html">Season 3</a></li>
				<li><a href="./about.html">About</a></li>
				<li><a class="active" href="./contact.html">Contact</a></li>
				<li><a href="./signup.html">Sign up</a></li>
			</ul>
		</nav>
	</header>
	<main id="top">
        <!-- If the message sends succesfully -->
        <?php
        if($message_sent):
        ?>
        <section class="contact-form">
            <div>
                <h2>Get in touch</h2>
                <h3>We will get back to you <strong>ASAP</strong>. Avg. response time is 2-3 days.</h3>
                <form action="./contactform.php" method="post">
                    <input type="text" name="name" id="name" placeholder="Name / Company">
                    <input type="text" name="email" id="email" placeholder="Your E-mail">
                    <input type="text" name="subject" id="subject" placeholder="Subject">
                    <textarea name="message" id="message" placeholder="Message"></textarea>
                    <button type="submit" name="submit">Send E-Mail</button>
                </form>
                <p>Your message was sent succesfully!</p>
                <h3>You can also send an email to ealesports@gmail.com. </h3>
            </div>
		</section>
        <!-- If the message fails to send or somebody gets to this page in some other way -->
        <?php
        else:
        ?>
        <section class="contact-form">
            <div>
                <h2>Get in touch</h2>
                <h3>Something went <strong>wrong</strong>. Please try again.</h3>
                <a href="./contact.html">Try Again ❯</a>
            </div>
		</section>
        <?php
        endif;
        ?>
        <section class="signup">
			<article>
				<h2>Sign up to EAL</h2>
				<p>Do you have an urge to show the world what you can do, or would you like to see if you can keep up with the big boys? 
					Join the EAL now, either with a team or as a free agent, and start fighting your way to the top!</p>
				<a href="./signup.html">Sign up ❯</a>
			</article>
			<aside>
				<img src="./Images/eal_logo_red.png" alt="EAL Logo">
			</aside>
		</section>
	</main>
	<footer>
		<div>
			<section>
				<a href="./index.html"><img src="./Images/eal_logo_white_graphic_big.svg" alt="EAL Esports Logo"></a>
				<ul>
					<li><a href="./index.html">Home</a></li>
					<li><a href="./news.html">News</a></li>
					<li><a href="./season3.html">Season 3</a></li>
					<li><a href="./about.html">About</a></li>
					<li><a href="./contact.html">Contact</a></li>
					<li><a href="./signup.html">Sign up</a></li>
				</ul>
				<ul>
					<li><a href="https://twitter.com/EAL_Esports"><img src="./Images/twitter_logo_white.svg" alt="Twitter Logo"></a></li>
					<li><a href="https://www.youtube.com/channel/UCAdsJ9r1xPv58Ubb_bhzzPg"><img src="./Images/yt_icon_mono_dark.svg" alt="Youtube Logo"></a></li>
					<li><a href="https://www.twitch.tv/eal_esports"><img src="./Images/twitch_logo_white.svg" alt="Twitch Logo"></a></li>
					<li><a href="https://www.reddit.com/r/EuropeanAmateurLeague/"><img src="./Images/reddit_mark_ondark.svg" alt="Reddit Logo"></a></li>
					<li><a href="https://discord.gg/vyanx4R4Ym"><img src="./Images/discord_logo_white.svg" alt="Discord Logo"></a></li>
				</ul>
			</section>
			<section>
				<ul>
					<li><p>2021 EAL Esports</p></li>
					<li><p>Hosted by Sophie</p></li>	
				</ul>				
				<a href="#top">Back to Top <span>▲</span></a>
			</section>
		</div>
	</footer> 
</body>
</html>