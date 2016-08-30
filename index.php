<!DOCTYPE html>
<?php 
        require_once 'load.php';
        date_default_timezone_set("America/New_York");

        $submitAsk = "Share your email for updates:";
        $submitError = "";
        $submitSuccess = "";
        $email = $zip = "";
        $emailErr = $zipErr = "";
        $optional = "* optional<br>";
        $asterisk = "*";

        $the_title = "Coming Soon...";
        $OpenYonder = "Open Yonder";
        $the_tagline = "... a place to find events and coordinate activities with friends";
        $the_content = "Open Yonder helps people with intellectual and "
                . "developmental disabilities take control of their social lives "
                . "- a simple, one-stop site for everything you and your friends "
                . "need to know about exciting events to hit the town. "
                . "Share your email to learn more or to get on a list for early access. "
                . "We open up events so you can go Yonder!";

        $check = $e->check_post();
        
        if (!empty($emailErr) || !empty($zip) || !empty($submitError) || !empty($submitSuccess)) {
            $submitAsk = "";
            $optional = "";
            $asterisk = "";
        };
?>
<html>
    <head>
	<meta charset="UTF-8">
        <link type="txt/css"  rel="stylesheet" href="stylesheet.css">
        <title>Open Yonder!</title>
    </head>
    <body>
    	<?php include_once("analyticstracking.php"); ?>
        <div class="behindcontent"></div>
        <div class="wrap">
            <div class="header">
                <h1><?php echo $the_title;?></h1>
            </div>
            <div class="OpenYonder">
                <h1><?php echo $OpenYonder;?></h1>
            </div>
            <div class='content'>
                <div class='main'>
                    <h2><?php echo $the_tagline;?></h2>
                    <p class="text"><?php echo $the_content;?></p>
                    <div id='form'>
                        <p>
                            <span class="ask"><?php echo $submitAsk;?></span>
                            <span class="alert"><?php echo $submitError;?></span>
                            <span class="alert"><?php echo $submitSuccess;?></span>
                        </p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="emailSubmit">
                            
                            <input type="text" placeholder="email" name="email" class="textin"><br>
                            <span class="alert"><?php echo $emailErr;?></span>
                            
                            <input type="text" placeholder="zip (optional)" name="zip" class="textin"><br>
                            <span class="alert"><?php echo $zipErr;?></span>
                            
                            <input type="hidden" name="datetime" value="<?php echo date(DATE_W3C);?>">
                            <input type="submit" name="submit" value="submit" class="subin">
                        </form>
                    </div>
                </div>
            </div>
            <div class ="push"></div>
            <div class="footer">
                <p>&copy; Open Yonder 2015</p>	
            </div>
        </div>
    </body>
</html>

