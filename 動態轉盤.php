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
	   .itext{
		   position:relative;
		   top:50px;
		   left:-40px;
	   }
	</style>
	<script>
	  var u = new Array();
	  var t = new Array();
	  var meals = new Array();
	  var minus_money, order_meal;
	  <?php
			$mainQurberger = $_GET['mainQurberger'];
			$length = count($mainQurberger);
	  ?>
	  var rangle = <?php echo 360/$length;?>;
	  var angle = rangle/2;
	  var circle;
	  var pc ,prices,temp_i;
	  function start(){
		 //localstorage start

			pc = localStorage.getItem('pc');
			prices = JSON.parse(localStorage.getItem('prices'));
			temp_i = localStorage.getItem('temp_i');
			if (pc && prices) {
				console.log(`預算: ${pc}`);
				console.log(`選中的價格: ${prices.join(', ')}`);
			} else {
				console.log("無法獲取數據，請返回上一步操作。");
			}		  
		//localstorage end
		  circle = document.querySelector('.circle');
		  circle.addEventListener("click",ro,false);
		  document.getElementById( "suree").addEventListener("click",cal,false);
		  document.getElementById( "要主餐").addEventListener("click",again,false);
		  document.getElementById( "不要主餐").addEventListener("click",drink,false);
		  document.getElementById( "要飲料").addEventListener("click",wantDrink,false);
		  document.getElementById( "不要飲料").addEventListener("click",noDrink,false);
		<?php for ($i = 0; $i < $length; $i++): ?>
			u[<?php echo $i; ?>] = "<?php echo $mainQurberger[$i]; ?>";
		<?php endfor; ?>
		 
	  }
	  function drink(){
		document.getElementById( "s").innerHTML = "你要飲料嗎?";
	 	document.getElementById( "要主餐").style.display = "none";
   	    document.getElementById( "不要主餐").style.display = "none";
		document.getElementById( "要飲料").style.display = "block";
		document.getElementById( "不要飲料").style.display = "block";
	  }
	  function noDrink(){
	 	document.getElementById( "sure").style.display = "block";
		document.getElementById( "要飲料").style.display = "none";
		document.getElementById( "不要飲料").style.display = "none";
		document.getElementById( "網頁").setAttribute("action","最終頁面.html");
	  }
	  function wantDrink(){
		document.getElementById( "s").innerHTML = "你要飲料嗎?";
		document.getElementById( "要飲料").style.display = "none";
		document.getElementById( "不要飲料").style.display = "none";
		document.getElementById( "sure").style.display = "block";
		document.getElementById( "網頁").setAttribute("action","麥味登飲料.html");
	  }
	  function again(){
	 	document.getElementById( "要主餐").style.display = "none";
   	    document.getElementById( "不要主餐").style.display = "none";
		document.getElementById( "suree").style.display = "block";
	  }
	  function cal(){
		  pc -= prices[minus_money];
		  //meals[temp_i] = order_meal;
		  let storedArray = JSON.parse(localStorage.getItem('meals')) || [];
		  storedArray.push(order_meal);
		  localStorage.setItem('meals', JSON.stringify(storedArray));
		  console.log("目前 localStorage 中的陣列：", storedArray);
		  //temp_i++;
		  localStorage.setItem('temp_i', temp_i);
		  localStorage.setItem('pc', pc);
		  alert(pc);
		  if(pc >= 35){ 
			document.getElementById( "s").innerHTML = "你要再轉一份主餐嗎?";
			  document.getElementById( "suree").style.display = "none";
			  document.getElementById( "要主餐").style.display = "block";
			  document.getElementById( "不要主餐").style.display = "block";
			//document.getElementById( "網頁").setAttribute("action","麥味登主餐.html");
		  }
		  else{
			  document.getElementById( "網頁").setAttribute("action","最終頁面.html");//要改連結
			  document.getElementById( "sure").style.display = "block";
			  document.getElementById( "suree").style.display = "none";
			  document.getElementById( "要主餐").style.display = "none";
			  document.getElementById( "不要主餐").style.display = "none";
		  }
	  }
	  function ro(){
			
        // 移除 class，方便下次可以重新觸發動畫
        setTimeout(() => {
		  angle += (rangle*(Math.floor(Math.random()*<?php echo $length;?>)+1)+360*3);
          circle.style.transform = 'translate(-50%, -50%) rotate('+angle+'deg)';
		  document.getElementById( "s").innerHTML = u[Math.floor(((angle-(rangle/2))%360)/rangle)];
		  minus_money = Math.floor(((angle-(rangle/2))%360)/rangle);
		  order_meal = u[Math.floor(((angle-(rangle/2))%360)/rangle)];
        }); 
		//document.getElementById( "s").innerHTML = u[Math.floor(((angle-(rangle/2))%360)/rangle)];
	  }

	  window.addEventListener( "load", start, false );
    </script>
</head>
<body>
    
		<?php
			print('<div class="container" id = "output">');
			$mainQurberger = $_GET['mainQurberger'];
			$length = count($mainQurberger);
			print('<div class="circle">Start</div>');
			if($length > 2){
				$deg = 360/$length;
				for($i = 0;$i < $length;$i++){
					print('<div class="item" style = "transform: rotate('.(-$deg).'deg);transform: rotate('.$deg*($i).'deg) skewY('.($deg - 90).'deg) scale(1.2);"><p class = "itext">'.$mainQurberger[$i].'</p></div>'); 
				}
			}
			else if($length == 2){
					print('<div style = "width: 260px; height: 520px; background-color: pink;text-align: right;display: flex; align-items: center; justify-content: center;">'.$mainQurberger[1].'</div>'); 
					print('<div class = "item2" style = "width: 260px; height: 520px; background-color:blue;text-align: left;">'.$mainQurberger[0].'</div>'); 
			}
			print('</div>');
			print('<p id = "s"></p>');
			print('<input type="button" id="suree" value="確認" />');
			print('<form method="get" action="#" id="網頁"><input style = "display:none;background-color:pink;" type="button" id="不要飲料" value="不要" /><input style = "display:none;background-color:pink;" type="button" id="要飲料" value="要" /><input style = "display:none;background-color:pink;" type="button" id="要主餐" value="要" /><input style = "display:none;background-color:pink;" type="button" id="不要主餐" value="不要" /><input type="submit" id="sure" value="下一步" style = "display: none; background-color: yellow;"/></form>');
		?>
	
    
</body>
</html>
