<!DOCTYPE html>
<html>
<head>
	<title>CodePath PHP pre work</title>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	<!-- If IE use the latest rendering engine -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cyborg/bootstrap.min.css" rel="stylesheet" integrity="sha384-D9XILkoivXN+bcvB2kSOowkIvIcBbNdoDQvfBNsxYAIieZbx8/SI4NeUvrRGCpDi" crossorigin="anonymous">
	
	<style type = "text/css">
		body{
			font-family: Verdana, Geneva, sans-serif;
			height: 70%;
			background-color: white;
		}
		#subbutton{
			margin-left: 10%;	
		}
		#action{
			text-align: left;	
			position:relative;
  		  	left:200;
    		right:0;
    		margin-left:25%;
    		margin-right:auto;
		
		}
		#background{
			
		}
		#wrapper{
			width: 40%;
			background-color: tan;
			text-align: center;
			float: center;
			border-radius: 10px;
			border-bottom-color: black;
			right: 20%;
			height: 400px;
			border-style: solid;
		}
		#header{
			color: white;
		}
		#operand1{
			width: 100px;
		}
		#operand2{
			width: 100px;
		}
		#operand3{
			width: 100px;
		}
		#outer{
			width: 40%;
			<!--	Used to center div -->
			display: table;
			margin: 0 auto;
		}
	</style>
</head>
<body>
<br/>
<!-- CONTAINERS -->
<!-- container puts padding around itself while container-fluid fills the whole screen. Bootstap grids require a container. -->
<div class="panel panel-primary" id="outer">
  <div class="panel-heading">
    <h3 class="panel-title">Tip Calculator</h3>
  </div>
  <div class="panel-body">
    <!--delete form-->
	<p class="lead">
		<p>Bill subtotal: $<input type = "text" name="operand1" id="operand1" placeholder="Number">
		</p>
		<p>Custom tip:
		&nbsp; &nbsp;<input type = "text" name="operand2" id="operand2" placeholder="Custom tip">%
		</p>
		<p>Split among:
		&nbsp; <input type = "text" name="operand3" id="operand3">people
		</p>
			Tip Percentage:<br/>
			<!--<div id= buttons>-->
			<!--<form action="pre_work_percent_result.php" method="GET">-->
			<?php
				/*For the form tag the attribute 'method' defines how to 
				  send the data. 
				  GET - sends via URL variables
				  POST - HTTP Post transaction 
				
				*/
				
				
				/*This premade function allows me to stop reporting errors
				the localhost webpage
				*/
				ini_set('display_errors', 0);
				/*This premade function is used display php documentation.
				*/
				//phpinfo();
				//This block of code can echo 3 radio buttons 
				//However, another approach may be taken using
				//The function underneath display_radio_buttons
				$arr = [];
				$i=1;
				for($i=1; $i<=4; $i++){
					//Prior to: made name of the php button had different names
					//			The name of each button was based on iterator $i
					//New approach:(12/27/16)	make all radio buttons the same
					//value attribute: (prior) php echo htmlspecialchars($i);
					
					//New approach:(12/28/16) use javascript to see which 
					//						  radio button was selected
					//						  This involves using the id
					//						  in the bottom html tag
					//				prior: used 'value'->w/ php code inside
					//echo '<input type ="radio" name ="percent" id="">';
					if($i==1){
						echo '<input type ="radio" name ="percent" id="ten">';
					} elseif($i==2){
						echo '<input type ="radio" name ="percent" id="fifteen">';
					} elseif($i==3){
						echo '<input type ="radio" name ="percent" id="twenty">';
					} elseif($i==4){
						echo '<input type="radio" name="percent" id="custom">';
					}
					
					//Inside the value attribute:
					//Used a snippet of html code 'htmlspecialchars'
					//This allows you to html-encode things inside
					//the html attributes
					//$arr = $_GET['percent'];	//prior: $_GET['$i'];
					if($i== 1){
						echo "10%" ."\n";
					} elseif($i==2){
						echo "15%"."\n";
					} elseif($i==3) {
						echo "20%"."\n";
					} elseif($i==4){
						echo "custom"."\n";
					}
					
				}
			
			?>
				<p>
				</p>
				<input type= "submit" name="calc" value="submit" id="subbutton" class="btn btn-primary" onclick="onClicked(); checkValidValues();" />  <!--Calculate-->
		<br>

		<p>
			<div id="tipValues">
				Tip: <div id="tipBox" onload="onClicked()">
				
				</div>
				Total bill: <div id="totalBill" onload="onClicked()">
				
				</div>
				<div id="splitPPL" onload="onClicked()">
				</div>
			</div>
		<?php
			/*function checkValidValues(){
				$billValue = $_GET['operand1'];
				$customTip = $_GET['operand2'];
				if($billValue<1 && $billValue!=null){
					echo "Please input a valid bill Value";
				} 
			}*/
		
		?>
	</p>
  </div>
</div>
	<script>
		//Another approach to take here would be
		//create a function (placed below) which will
		//be called when the submit button is clicked 
		
		function onClicked(){
			var billValue = document.getElementById("operand1").value;
			var splitPeople = document.getElementById('operand3').value;
			if(billValue>0){
				if(document.getElementById('ten').checked){
					var tipValue = billValue * 1.10;
					document.getElementById("tipBox").innerHTML = ".10";
					tipValue = Math.round(tipValue * 100)/100;
					document.getElementById("totalBill").innerHTML = "$"+tipValue;
					
					if(splitPeople>0){
						var tipPerPerson = billValue * .10;
						tipPerPerson = tipPerPerson/splitPeople;
						
						var totalPerPerson = billValue * (1.10);
						totalPerPerson = totalPerPerson/splitPeople;
						
						tipPerPerson = Math.round(tipPerPerson * 100)/100;
						totalPerPerson = Math.round(totalPerPerson * 100)/100;
						document.getElementById("splitPPL").innerHTML = "tip per person: " + tipPerPerson 
																		+ "\ntotal per person: $" + totalPerPerson;													+ "\n" + "total per person: " + totalPerPerson;
					}
					
				} else if(document.getElementById('fifteen').checked){
					var tipValue = billValue * 1.15;
					document.getElementById("tipBox").innerHTML = ".15";
					tipValue = Math.round(tipValue * 100)/100;
					document.getElementById("totalBill").innerHTML ="$"+ tipValue;
					if(splitPeople>0){
						var tipPerPerson = billValue * .15;
						tipPerPerson = tipPerPerson/splitPeople;
						
						var totalPerPerson = billValue * (1.15);
						totalPerPerson = totalPerPerson/splitPeople;
						
						tipPerPerson = Math.round(tipPerPerson * 100)/100;
						totalPerPerson = Math.round(totalPerPerson * 100)/100;
						document.getElementById("splitPPL").innerHTML = "tip per person: " + tipPerPerson 
																		+ "\ntotal per person: $" + totalPerPerson;													+ "\n" + "total per person: " + totalPerPerson;
					}
				} else if(document.getElementById('twenty').checked){
					var tipValue = billValue * 1.20;
					document.getElementById("tipBox").innerHTML = ".20";
					tipValue = Math.round(tipValue * 100)/100;
					document.getElementById("totalBill").innerHTML ="$"+ tipValue;
					if(splitPeople>0){
						var tipPerPerson = billValue * .15;
						tipPerPerson = tipPerPerson/splitPeople;
						
						var totalPerPerson = billValue * (1.15);
						totalPerPerson = totalPerPerson/splitPeople;
						
						tipPerPerson = Math.round(tipPerPerson * 100)/100;
						totalPerPerson = Math.round(totalPerPerson * 100)/100;
						document.getElementById("splitPPL").innerHTML = "tip per person: " + tipPerPerson 
																		+ "\ntotal per person: $" + totalPerPerson;													+ "\n" + "total per person: " + totalPerPerson;
					}
				} else if(document.getElementById('custom').checked){
					var customTip = document.getElementById("operand2").value;
					if(customTip>0){
						customTip = customTip/100;
						var tipValue = billValue * (customTip+1);
						tipValue = Math.round(tipValue * 100)/100;
						document.getElementById("tipBox").innerHTML = customTip;
						document.getElementById("totalBill").innerHTML ="$"+ tipValue;
						
						if(splitPeople>0){
						var tipPerPerson = billValue * customTip;
						tipPerPerson = tipPerPerson/splitPeople;
						
						var totalPerPerson = billValue * (customTip+1);
						totalPerPerson = totalPerPerson/splitPeople;
						
						tipPerPerson = Math.round(tipPerPerson * 100)/100;
						totalPerPerson = Math.round(totalPerPerson * 100)/100;
						document.getElementById("splitPPL").innerHTML = "tip per person: " + tipPerPerson 
																		+ "\ntotal per person: $" + totalPerPerson;													+ "\n" + "total per person: " + totalPerPerson;
					}
					} else{
						document.getElementById("tipBox").innerHTML ="Please place a valid tip value";
					}
				}
				
			} else{
				document.getElementById("tipBox").innerHTML="Please re-enter a valid tip value";
			}
			return false;
		}
	</script>
		</p>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
