<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta name="viewport" content="user-scalable=no,width=640px"/>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"  />
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<title>We DJ!</title>
</head>
<body>

<div id="container">
	<div id="header">
		WE DJ
		<div id="back">
			<a href="index.php"><img src="back.png" /></a>
		</div>
	</div>
<div id="main">
	<p style="line-height:50px">Sorry! That name is already taken. You can choose a similar name:</p>
	<div style="margin-bottom: 20px">
		<div style="float:left; clear:left; width:80%">
                	<div class="go-button">
                        	<a href="partypage.php"><img src="images/go.png" /></a>
                	</div>
                	<span>party1</span>
        	</div>
		<div style="float:left; clear:left; width:80%">
                        <div class="go-button">
                                <a href="partypage.php"><img src="images/go.png" /></a>
                        </div>
                        <span>party2</span>
                </div>
		<div style="float:left; clear:left; width:80%">
                        <div class="go-button">
                                <a href="partypage.php"><img src="images/go.png" /></a>
                        </div>
                        <span>party3</span>
                </div>
	</div>
	<p style="clear:left;display:inline-block">
		Or try a different name:
	</p>
	<div style="float:left">
                <div class="go-button">
                        <a href="partypage.php"><img src="images/go.png" /></a>
                </div>
                <input 
                        type="text"
                        name="keyword"
                        size="12"
                        onfocus="if(this.value==this.defaultValue){this.value='';}"
                        value="Enter a new party name"
                        class="big-input"
                />
        </div>
</div>
</div>

</body>

</html>
