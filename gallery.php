<?php
    include 'template_start.php';
?>
<div>
	
	<br><a href = "index.php"> <center> <img src = "Emblema1.png" width = "200" height = "200" /> </center> </a><br>
</div>



<style> 
#gall {
  position: relative;
  padding-top: 50%;
  -moz-user-select: none; user-select: none;
}
#gall img {
  position: absolute;
  top: 25%;
  left: 12.5%;
  max-width: 24.5%;
  max-height: 49.5%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  cursor: zoom-in;
  transition: .2s;
}
#gall img:nth-child(4n-2) {left: 37.5%;}
#gall img:nth-child(4n-1) {left: 62.5%;}
#gall img:nth-child(4n) {left: 87.5%;}
#gall img:nth-child(n+5) {top: 75%;}

#gall img:focus {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 1;
  max-width: 100%;
  max-height: 100%;
  outline: none;
  pointer-events: none;
}
#gall img:focus ~ div {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #fff;
  cursor: zoom-out;
}
</style>
<body>
<div id="gall">
<img src="images/gallery1.jpg" tabindex="0" border="3"/>   
<img src="images/gallery2.jpg" tabindex="0" border="3"/> 
<img src="images/gallery3.jpg" tabindex="0" border="3"/>
<img src="images/gallery4.jpg" tabindex="0" border="3"/>   
<img src="images/gallery5.jpg" tabindex="0" border="3"/>
<img src="images/gallery6.jpg" tabindex="0" border="3"/>  
<img src="images/gallery7.jpg" tabindex="0" border="3"/>
<img src="images/gallery8.jpg" tabindex="0" border="3"/> 

<div></div>
</div>
</body>
<?php
    include 'template_end.php';
?>