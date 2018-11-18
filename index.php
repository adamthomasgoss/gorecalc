<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../../images/favicon.ico" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DIY Planetarium | GORE CALCULATOR</title>
    <link href="../../diy_styles.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui-1.8.17.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<style type="text/css">
	#wrapper #mainWrapper form table {
	text-align: center;
}
    </style>
	<script type="text/javascript" src="../js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="../../jspdf.js"></script>
	<script type="text/javascript" src="../../libs/FileSaver.js/FileSaver.js"></script>
	<script type="text/javascript" src="../../libs/BlobBuilder.js/BlobBuilder.js"></script>

	<script type="text/javascript" src="../../jspdf.plugin.addimage.js"></script>

	<script type="text/javascript" src="../../jspdf.plugin.standard_fonts_metrics.js"></script>
	<script type="text/javascript" src="../../jspdf.plugin.split_text_to_size.js"></script>
	<script type="text/javascript" src="../../jspdf.plugin.from_html.js"></script>
	<script type="text/javascript" src="../js/basic.js"></script>
	
	<script>
		$(function() {
			$("#accordion-basic, #accordion-text, #accordion-graphic").accordion({
				autoHeight: false,
				navigation: true
			});
			$( "#tabs" ).tabs();
			$(".button").button();
		});
	</script>
</head>

<body>
<div id="wrapper">
	<div id="nav">
      <div id="nav1"><a href="../../index.html">home</a></div>
      <div id="nav2"><a href="../../productions">productions</a></div>
      <div id="nav3"><a href="../../domes">domes</a></div>
      <div id="nav4"><a href="../../photos">photos</a></div>
      <div id="nav5current"><a href="index.php">software</a></div>
      <div id="nav6"><a href="../../contact">contact</a></div>
	</div>
  <div id="header"><a href="../../index.html"><img src="../../images/header.png" width="900" height="300" /></a></div>
  <div id="mainWrapper">
  <div id="mainWrapperTopSpacer"></div>
  <h1>GORE CALCULATOR</h1><hr>

  	  <div class="border1px">
        <form action="index.php" method="post">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td height="50" bgcolor="#6699CB"><strong>Lateral Divisions</strong></td>
                <td height="50" bgcolor="#6699CB"><strong>Material Width</strong></td>
                <td height="50" bgcolor="#6699CB"><strong>Dome Diameter</strong></td>
              </tr>
              <tr>
                <td height="36">(Integer Value): <input type="text" name="lateralDivisions"><br></td>                
                <td height="36">(in Meters): <input type="text" name="materialWidth"><br></td>
                <td height="36">(in Meters): <input type="text" name="domeDiameter"><br></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <div class="centerBox">
              <p>
                <input type="submit" value="Create This Pattern!">
              </p>
            </div>            
        </form>
      </div>
		
		<?php 
			// Dome Defaults
			if(!isset($_SESSION['lateralDivisions']))
				$_SESSION['lateralDivisions'] = 18;
			if(!isset($_SESSION['materialWidth']))
				$_SESSION['materialWidth'] = 1;
			if(!isset($_SESSION['domeDiameter']))
				$_SESSION['domeDiameter'] = 5;
			if(!isset($_SESSION['numSections']))
				$_SESSION['numSections'] = 1;
			if(!isset($_SESSION['baseWidth']))
				$_SESSION['baseWidth']=0;
			if(!isset($_SESSION['goreLength']))
				$_SESSION['goreLength']=3.92;
			if(!isset($_SESSION['heightToBase']))
				$_SESSION['heightToBase']=0;
			
			// POST Variables
			if(isset($_POST['lateralDivisions']) && !is_null($_POST['lateralDivisions']) && $_POST['lateralDivisions']!="" && is_numeric($_POST['lateralDivisions']))
			{
				if($_SESSION['lateralDivisions'] != $_POST['lateralDivisions'])
					$_SESSION['lateralDivisions'] = ceil($_POST['lateralDivisions']);
					// Make sure lateralDivisions != 0
					$_SESSION['lateralDivisions'] = $_SESSION['lateralDivisions'] > 0 ? $_SESSION['lateralDivisions'] : 10;
			}
			if(isset($_POST['materialWidth']) && !is_null($_POST['materialWidth']) && $_POST['materialWidth']!="" && is_numeric($_POST['materialWidth']))
			{
				if($_SESSION['materialWidth'] != $_POST['materialWidth'])
					$_SESSION['materialWidth'] = $_POST['materialWidth'];
			}
			if(isset($_POST['domeDiameter']) && !is_null($_POST['domeDiameter']) && $_POST['domeDiameter']!="" && is_numeric($_POST['domeDiameter']))
			{
				if($_SESSION['domeDiameter'] != $_POST['domeDiameter'])
					$_SESSION['domeDiameter'] = $_POST['domeDiameter'];
			}
		?>
        
    <hr>
  
  
  
  		<iframe frameborder="0" width="100%" height="1200"></iframe>
		<script>
        $(document).ready(function() {
        
            var pdf = new jsPDF()
            , sizes = [12, 16, 20]
            , fonts = [['Josefin Sans','']]
            , font, size, lines
            , margin = 0.5 // inches on a 8.5 x 11 inch sheet.
            , verticalOffset = margin
            , loremipsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id eros turpis. Vivamus tempor urna vitae sapien mollis molestie. Vestibulum in lectus non enim bibendum laoreet at at libero. Etiam malesuada erat sed sem blandit in varius orci porttitor. Sed at sapien urna. Fusce augue ipsum, molestie et adipiscing at, varius quis enim. Morbi sed magna est, vel vestibulum urna. Sed tempor ipsum vel mi pretium at elementum urna tempor. Nulla faucibus consectetur felis, elementum venenatis mi mollis gravida. Aliquam mi ante, accumsan eu tempus vitae, viverra quis justo.\n\nProin feugiat augue in augue rhoncus eu cursus tellus laoreet. Pellentesque eu sapien at diam porttitor venenatis nec vitae velit. Donec ultrices volutpat lectus eget vehicula. Nam eu erat mi, in pulvinar eros. Mauris viverra porta orci, et vehicula lectus sagittis id. Nullam at magna vitae nunc fringilla posuere. Duis volutpat malesuada ornare. Nulla in eros metus. Vivamus a posuere libero.'
			
			pdf.setFont("helvetica");
			pdf.setFontType("normal");
			pdf.setFontSize(24);
			
			// Calculate Num Sections
			// ceil(pi*diameter/MatWidth)
			<?php
				if($_SESSION['materialWidth']>$_SESSION['domeDiameter']){$_SESSION['materialWidth']=$_SESSION['domeDiameter'];}
				$_SESSION['numSections'] = ceil(3.14159265358979323846264338327*$_SESSION['domeDiameter']/$_SESSION['materialWidth']);
				$_SESSION['baseWidth']=3.14159265358979323846264338327*$_SESSION['domeDiameter']/$_SESSION['numSections'];
				$_SESSION['goreLength']=3.14159265358979323846264338327*$_SESSION['domeDiameter']/4;
                $_SESSION['spaceHeight'] = $_SESSION['goreLength']/$_SESSION['lateralDivisions'];
				$_SESSION['heightToBase']=$_SESSION['goreLength']/$_SESSION['baseWidth']; //if > 1, taller than wide. if < 1, wider than tall.
			?>
			
			// Header
			pdf.setFillColor(155,188,221);
			pdf.rect(0, 0, 210, 27, 'F'); 
			pdf.setFillColor(102,153,203);
			pdf.rect(0, 26, 210, 2, 'F');
			pdf.text(<?=(100 - (strlen($_SESSION['domeDiameter']))*4.6)?>, 16, '<?=$_SESSION['domeDiameter']?> Meter Planetarium Pattern');
			pdf.setFontSize(13);

			// Mainframe
			pdf.setFillColor(0,0,0);			
			pdf.rect(10, 37, 190, 241);
			
			// Gridlines
			pdf.setLineWidth(0.25);
			pdf.setDrawColor(125,125,125);
			pdf.line(200, 265, 10, 265);
			pdf.line(153, 37, 153, 265);
			
			// Gore XY Axis
			pdf.setDrawColor(200,200,200);
			pdf.line(153, 255, 10, 255);			
			pdf.line(81, 37, 81, 265);
			
			// Dimension Lines
			pdf.setDrawColor(200,200,200);
			pdf.line(153, 255, 10, 255);			
			pdf.line(81, 37, 81, 265);
            pdf.line(177, 37, 177, 265);
			
			// Gore Baselines
			// DIMENSIONS: 133 wide, 208 tall
			pdf.setDrawColor(255,50,50);
			pdf.setLineWidth(0.5);
			<?php
			if($_SESSION['heightToBase']>=1.691) // hotdog
			{
				echo "pdf.line(81, 47, 81, 255);"; //|
				echo "pdf.line(".(81-(104*$_SESSION['baseWidth']/$_SESSION['goreLength'])).", 255, 81, 255);"; //-
				echo "pdf.line(81, 255, ".(81+(104*$_SESSION['baseWidth']/$_SESSION['goreLength'])).", 255);"; //-
				echo "pdf.setDrawColor(0,0,0);";
				$_SESSION['pixelHeight']=208;
				$_SESSION['pixelWidth']=(208*$_SESSION['baseWidth']/$_SESSION['goreLength']);
				
				$count=0;
				$max = ceil($_SESSION['pixelHeight']);
				$prevLeft = 81-($_SESSION['pixelWidth']/2);
				$prevRight = 81+($_SESSION['pixelWidth']/2);
                $currentSection = 0;
				while($count<=$max)
				{
					echo "pdf.setFontSize(10);";
					$angle = ($count/$max*90*3.141592653589793238462643383279502884197/180);
					$radiusAtX = cos($angle)*$_SESSION['domeDiameter']/2;
					$widthAtX = 3.141592653589793238462643383279502884167*$radiusAtX*2/$_SESSION['numSections'];
					
					// if dimension line/text
					if(($count%(ceil($_SESSION['pixelHeight']/$_SESSION['lateralDivisions'])))==0)
					{
                        // dimensions (widths)
						echo "pdf.text(161, ".(255-$count+1).", '".round($widthAtX, 2)."(m)');";
                        // dimensions (heights)
                        $heightAtX = $_SESSION['goreLength']*$currentSection/($_SESSION['lateralDivisions']);
                        $heightAtX = $_SESSION['spaceHeight']*$currentSection;
                        echo "pdf.text(183, ".(255-$count+1).", '".round($heightAtX, 2)."(m)');";
						
						// grey lines
						echo "pdf.setDrawColor(112,112,112);";
						echo "pdf.line(81, ".(255-$count).", 160, ".(255-$count).");"; //-

						// gore lines
						echo "pdf.setDrawColor(255,0,0);";
						echo "pdf.line(81, ".(255-$count).", ".$prevLeft.", ".(255-$count).");"; //-
						echo "pdf.line(81, ".(255-$count).", ".$prevRight.", ".(255-$count).");"; //-
						
						// left circles
						//echo "pdf.circle(".(81-((81-$prevLeft)/2)).", ".(255-$count+1).", 5, 'FD');";
                        $currentSection++;
					}
					elseif($count==$max)
					{
						// dimensions (widths)
						echo "pdf.text(161, ".(255-$count+1).", '".round($widthAtX, 2)."(m)');";
                        // dimensions (heights)
                        $heightAtX = $_SESSION['goreLength']*$currentSection/($_SESSION['lateralDivisions']);
                        echo "pdf.text(183, ".(255-$count+1).", '".round($heightAtX, 2)."(m)');";
						
						// grey lines
						echo "pdf.setDrawColor(112,112,112);";
						echo "pdf.line(81, ".(254-$count).", 160, ".(254-$count).");"; //-
					}
					echo "pdf.setDrawColor(0,0,0);";
					$widthAtX2 = $widthAtX/2;
					$pixelWidth = (208*$widthAtX/$_SESSION['goreLength']);
					$pixelWidth2 = $pixelWidth/2;					
					echo "pdf.line(".(81-$pixelWidth2).", ".(255-$count-1).", ".($prevLeft).", ".((255-$count)).");"; //-
					echo "pdf.line(".(81+$pixelWidth2).", ".(255-$count-1).", ".($prevRight).", ".((255-$count)).");"; //-
					$prevLeft = 81 - $pixelWidth2;
					$prevRight = 81 + $pixelWidth2;
					$count++;
				}
                // Width Title
				echo "pdf.text(161, ".(255-$max-4).", 'Width');";
                // Height Title
				echo "pdf.text(183, ".(255-$max-4).", 'Height');";
				
				
				// Other Titles
				echo "pdf.text(15, ".(255-$max-4).", 'Gore Length: ".$_SESSION['goreLength']."');";
				echo "pdf.text(15, ".(255-$max-0).", 'Pixel Height: ".$_SESSION['pixelHeight']."');";
				echo "pdf.text(15, ".(255-$max+4).", 'Pixel Width: ".$_SESSION['pixelWidth']."');";
				echo "pdf.text(15, ".(255-$max+8).", 'Space Height: ".$_SESSION['spaceHeight']."');";
				echo "pdf.text(15, ".(255-$max+12).", 'Lateral Divisions: ".$_SESSION['lateralDivisions']."');";
			}
			if($_SESSION['heightToBase']<1.691) // hamburger
			{
				echo "pdf.line(143, 255, 20, 255);"; //-
				echo "pdf.line(81, ".(255-(123*$_SESSION['heightToBase'])).", 81, 255);";   //|
				echo "pdf.setDrawColor(0,0,0);";				
				$_SESSION['pixelHeight']=(123*$_SESSION['heightToBase']);	
				$_SESSION['pixelWidth']=123;
				
				$count=0;
				$max = ceil($_SESSION['pixelHeight']);
				$prevLeft = 81-($_SESSION['pixelWidth']/2);
				$prevRight = 81+($_SESSION['pixelWidth']/2);
				while($count<=$max)
				{
					echo "pdf.setFontSize(10);";
					$angle = ($count/$max*90*3.141592653589793238462643383279502884197/180);
					$radiusAtX = cos($angle)*$_SESSION['domeDiameter']/2;
					$widthAtX = 3.141592653589793238462643383279502884167*$radiusAtX*2/$_SESSION['numSections'];			
					if((ceil($count%($_SESSION['pixelHeight']/$_SESSION['lateralDivisions'])))==0)
					{
						// dimensions (widths)
						echo "pdf.text(161, ".(255-$count+1).", '".round($widthAtX, 2)."(m)');";
						
						// grey lines
						echo "pdf.setDrawColor(112,112,112);";
						echo "pdf.line(81, ".(255-$count).", 160, ".(255-$count).");"; //-

						// gore lines
						echo "pdf.setDrawColor(255,0,0);";
						echo "pdf.line(81, ".(255-$count).", ".$prevLeft.", ".(255-$count).");"; //-
						echo "pdf.line(81, ".(255-$count).", ".$prevRight.", ".(255-$count).");"; //-
					}
					if($count==$max)
					{
						// dimensions (widths)
						echo "pdf.text(161, ".(255-$count+1).", '".round($widthAtX, 2)."(m)');";
						
						// grey lines
						echo "pdf.setDrawColor(112,112,112);";
						echo "pdf.line(81, ".(254-$count).", 160, ".(254-$count).");"; //-
					}
					echo "pdf.setDrawColor(0,0,0);";					
					$widthAtX2 = $widthAtX/2;
					$pixelWidth = (123*$widthAtX/$_SESSION['goreLength']);
					$pixelWidth2 = $pixelWidth/2;					
					echo "pdf.line(".(81-$pixelWidth2).", ".(255-$count-1).", ".($prevLeft).", ".((255-$count)).");"; //-
					echo "pdf.line(".(81+$pixelWidth2).", ".(255-$count-1).", ".($prevRight).", ".((255-$count)).");"; //-
					$prevLeft = 81 - $pixelWidth2;
					$prevRight = 81 + $pixelWidth2;
					$count++;
				}
			}
			?>
	
			
			
			// Gore Outlines
			
			// Bottom Info
			pdf.setFontSize(13);			
			pdf.text(15, 273, 'Number of Sections Required: <?=$_SESSION['numSections']?>');
			
			// Footer
			pdf.setFillColor(100,100,100);
			pdf.rect(0, 288, 210, 15, 'F');
			pdf.setFillColor(102,153,203);
			pdf.rect(0, 288, 210, 2, 'F');

            //pdf.setFillColor(0,0,255);
            //pdf.ellipse(80, 60, 10, 5, 'F');
            //pdf.setLineWidth(1);
            //pdf.setDrawColor(0);
            //pdf.setFillColor(255,0,0);
            //pdf.circle(120, 60, 5, 'FD');
        
            var string = pdf.output('datauristring');
        
            $('iframe').attr('src', string);
        });
        </script>
  
  
  </div>
  <div id="footer"><strong>©</strong>2014 adaMagination</div>
</div>

</body>
</html>
