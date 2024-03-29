<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>New Apple-Style Flip Counter Demo</title>
	<meta name="description" content="A more functional version of my Apple-Style Flip Counter." />
	<meta name="keywords" content="HTML,CSS,JavaScript,counter,apple-style,flip,animate,digit,demo" />
	<meta name="author" content="Chris Nanney" />

	<!-- My flip counter script, REQUIRED -->
	<script type="text/javascript" src="js/flipcounter.js"></script>
	<!-- Style sheet for the counter, REQUIRED -->
	<link rel="stylesheet" type="text/css" href="css/counter.css" />
	

	<!-- NOT REQUIRED FOR COUNTER TO FUNCTION, JUST FOR DEMO PURPOSES -->
	<!-- jQuery from Google CDN, NOT REQUIRED for the counter itself -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<!-- jQueryUI from Google CDN, used only for the fancy demo controls, NOT REQUIRED for the counter itself -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
	<!-- Style sheet for the jQueryUI controls, NOT REQUIRED for the counter itself -->
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/vader/jquery-ui.css" />
	<!-- Style sheet for the demo page, NOT REQUIRED for the counter itself -->
	<link rel="stylesheet" type="text/css" href="css/demo.css" />

</head>

<body>

	<div class="explain">
		<p>This counter was initialized with the following code:</p>
		<code>var myCounter = new flipCounter('flip-counter', {value:10000, inc:123, pace:600, auto:true});</code>
		<p>Use the controls below to make changes to the counter using built-in methods.</p>
		<p><a class="back" href="http://cnanney.com/journal/code/apple-style-counter-revisited/">http://cnanney.com/journal/code/apple-style-counter-revisited/</a></p>
	</div>

	<div id="wrapper"><div id="flip-counter" class="flip-counter"></div></div>

	<div class="clear"></div>
	<ul id="demo_controls">
		<li class="auto_on_controls">Increment: 
			<span id="inc_value">123</span> <a href="#" class="expand">[?]</a><div id="inc_slider" class="demo_widget"></div>
			<div class="explain toggle">
				<p>This slider controls the counter increment by using the <b>setIncrement</b> method:</p>
				<code>myCounter.setIncrement(value);</code>
			</div>
		</li>
		<li class="auto_on_controls">Pace: 
			<span id="pace_value">600</span>ms <a href="#" class="expand">[?]</a><div id="pace_slider" class="demo_widget"></div>
			<div class="explain toggle">
				<p>This slider controls the counter pace by using the <b>setPace</b> method:</p>
				<code>myCounter.setPace(value);</code>
			</div>
		</li>
		<li>Auto-Increment: <a href="#" class="expand">[?]</a>
			<div id="auto_toggle" class="demo_button">
				<input type="radio" id="auto1" name="auto" value="on" checked="checked" /><label for="auto1">On</label>
				<input type="radio" id="auto2" name="auto" value="off" /><label for="auto2">Off</label>
				<button id="counter_step">Step</button>
			</div>
			<div class="explain toggle">
				<p>These buttons start and stop auto-incrementing the counter using the <b>setAuto</b> method:</p>
				<code>myCounter.setAuto(false);</code>
				<p>When auto-increment is off, you can use the third button to step through the animation one increment at a time using the <b>step</b> method:</p>
				<code>myCounter.step();</code>
			</div>
		</li>
		<li class="auto_off_controls">Addition / Subtraction: <a href="#" class="expand">[?]</a>
			<div id="add_sub" class="demo_button">
				<button id="add">Add 567</button>
				<button id="sub">Subtract 567</button>
			</div>
			<div class="explain toggle">
				<p>You can also add and subtract a value to/from the counter using the <b>add</b> and <b>subtract</b> methods:</p>
				<code>myCounter.add(567);</code>
				<code>myCounter.subtract(567);</code>
			</div>
		</li>
		<li class="auto_off_controls">Set Value: <a href="#" class="expand">[?]</a>
			<div class="demo_button">
				<button id="set_val">Set value of counter to 12,345</button>
			</div>
			<div class="explain toggle">
				<p>You can manually set the value of the counter at any time using the <b>setValue</b> method:</p>
				<code>myCounter.setValue(12345);</code>
			</div>
		</li>
		<li class="auto_off_controls">Increment To: <a href="#" class="expand">[?]</a>
			<div class="demo_button">
				<button id="inc_to">Increment counter to 12,345</button>
			</div>
			<div class="explain toggle">
				<p>You can set the counter to increment to a value using the current <i>pace</i> and <i>inc</i> values by using the <b>incrementTo</b> method:</p>
				<code>myCounter.incrementTo(12345);</code>
			</div>
		</li>
	</ul>
	<?php date_default_timezone_set("Pacific/Auckland"); var_dump(date("H:i:s"));?>
	<script type="text/javascript">
	//<![CDATA[

	$(function(){
		
		// Initialize a new counter
		var myCounter = new flipCounter('flip-counter', {value:<?php echo time() - strtotime("2011-06-10 11:30")  ?>, dec:-123, pace:1000, auto:true});

		/**
		 * Demo controls
		 */
		
		var smartInc = 0;
		
		// Increment
		$("#inc_slider").slider({
			range: "max",
			value: 123,
			min: 1,
			max: 1000,
			slide: function( event, ui ) {
				myCounter.setIncrement(ui.value);
				$("#inc_value").text(ui.value);
			}
		});
		
		// Pace
		$("#pace_slider").slider({
			range: "max",
			value: 600,
			min: 100,
			max: 2000,
			step: 100,
			slide: function( event, ui ) {
				myCounter.setPace(ui.value);
				$("#pace_value").text(ui.value);
			}
		});
		
		// Auto-increment
		$("#auto_toggle").buttonset();
		$("input[name=auto]").change(function(){
			if ($("#auto1:checked").length == 1){
				$("#counter_step").button({disabled: true});
				$(".auto_off_controls").hide();
				$(".auto_on_controls").show();
				
				myCounter.setPace($("#pace_slider").slider("value"));
				myCounter.setIncrement($("#inc_slider").slider("value"));
				myCounter.setAuto(true);
			}
			else{
				$("#counter_step").button({disabled: false});
				$(".auto_off_controls").show();
				$(".auto_on_controls").hide();
				$("#add_sub").buttonset();
				$("#set_val, #inc_to, #smart").button();
				myCounter.setAuto(false).stop();
			}
		});
		$("#counter_step").button({disabled: true});
		$("#counter_step").button().click(function(){
			myCounter.step();
			return false;
		});
		
		// Addition/Subtraction
		$("#add").click(function(){
			myCounter.add(567);
			return false;
		});
		$("#sub").click(function(){
			myCounter.subtract(567);
			return false;
		});
		
		// Set value
		$("#set_val").click(function(){
			myCounter.setValue(12345);
			return false;
		});
		
		// Increment to
		$("#inc_to").click(function(){
			myCounter.incrementTo(12345);
			return false;
		});
		
		// Get value
		$("#smart").click(function(){
			var steps = [12345, 17, 4, 533];

			if (smartInc < 4) runTest();
			
			function runTest(){
				var newVal = myCounter.getValue() + steps[smartInc];
				myCounter.incrementTo(newVal, 10, 600);
				smartInc++;
				if (smartInc < 4) setTimeout(runTest, 10000);
			}
			$(this).button("disable");
			return false;
		});
		
		// Expand help
		$("a.expand").click(function(){
			$(this).parent().children(".toggle").slideToggle(200);
			return false;
		});

	});

	//]]>
	</script>
</body>

</html>
