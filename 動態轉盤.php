<!DOCTYPE html>
<html>
<head>
    <title>動態轉盤</title>
    <meta charset="utf-8">
    <style>
		.container {
		 display: block;
		 width: 520px;
		 height: 520px;
		 border-radius: 520px;
		 overflow: hidden;
		 position: relative;
		 background-color: #f0beff;
		}

		.item {
		 position: absolute;
		 display: flex;
		 width: 50%;
		 height: 50%;
		 border: 2px solid #1f1172;
		 color: black;
		 background-color: #343baa;
		 top: 0;
		 right: 0;
		 transform-origin: 0% 100%;
		 justify-content: center;
		 align-items: center;
		}
		.item2{
		 position: absolute;
		 display: flex;
		 width: 260px;
		 height: 520px;
		 border: 2px solid #1f1172;
		 color: black;
		 background-color: #343baa;
		 top: 0;
		 right: 0;
		 transform-origin: 0% 100%;
		 justify-content: center;
		 align-items: center;
			
		}
       .circle {
			position: absolute;
			border-radius: 50%;
			border: 1px solid black;
			background-color: yellow;
			width: 100px;
			height: 100px;
			z-index: 1;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			display: flex;
			justify-content: center;
			align-items: center;
			font-weight: bold;
			font-size: 1.2rem;
			transition: transform 1s;
       }

	</style>
	<script>
	  var co = ["Laya漢堡","麥味登","美而美","美之城","Qburger"];
	  <?php
			$mainQurberger = $_POST['mainQurberger'];
			$length = count($mainQurberger);
	  ?>
	  var rangle = <?php echo 360/$length;?>;
	  var angle = rangle/2;
	  var circle;
	  function start(){
		  circle = document.querySelector('.circle');
		  circle.addEventListener("click",ro,false);
		  
	  }
	  function ro(){
			
        // 移除 class，方便下次可以重新觸發動畫
        setTimeout(() => {
		  angle += (rangle*(Math.floor(Math.random()*<?php echo $length;?>)+1)+360*3);
          circle.style.transform = 'translate(-50%, -50%) rotate('+angle+'deg)';
		  //document.getElementById( "s").innerHTML = co[Math.floor(((angle-36)%360)/72)];
        }); 
		//document.getElementById( "s").innerHTML = " " + angle + " " + co[Math.floor(((angle-36)%360)/72)];


	  }
	  window.addEventListener( "load", start, false );
    </script>
</head>
<body>
    
		<?php
			print('<div class="container" id = "output">');
			$mainQurberger = $_POST['mainQurberger'];
			$length = count($mainQurberger);
			print('<div class="circle">Start</div>');
			if($length > 2){
				$deg = 360/$length;
				for($i = 0;$i < $length;$i++){
					print('<div class="item" style = "transform: rotate('.$deg*($i+1).'deg) skewY('.($deg - 90).'deg) scale(1.2);">'.$mainQurberger[$i].'</div>'); 
				}
			}
			else if($length == 2){
				for($i = 0;$i < $length;$i++){
					print('<div style = "width: 260px; height: 520px; background-color: pink;text-align: right;">'.$mainQurberger[0].'</div>'); 
					print('<div class = "item2" style = "width: 260px; height: 520px; background-color:blue;text-align: left;">'.$mainQurberger[1].'</div>'); 
				}
			}
			print('</div>');
		?>
	
    
</body>
</html>
