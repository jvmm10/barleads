<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $title;?></title>
<?php echo $css; echo $javascript; ?>
</head>

<body>
    
<div id="container">
	<div id="header_logo">
        <h1 id="logo_text"><span id="logo"> </span>SP Madrid and Associates Law Firm</h1>
        
        
        	<ul id="logout">
            	<li >Settings
                <ul>
                    	<li><a href="#">Edit Profile</a></li>
                    	<li><a href="../error/logout">Logout</a></li>
                    </ul>
                </li>
                	
            </ul>
      
    </div>
    <br / style="clear:both">
<?php $menu =  $this->uri->segment(1);?>
<?php echo $this->globals->menu($menu,$this->session->userdata('role'));?>

<div id="content">



    


	
	

