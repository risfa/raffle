<?php
session_start();
$date=date('Ymd');
?>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<?php
if($_SESSION["input"]!=$date){
	$file = file("data.txt");
?>
<h1><?php echo date("d F Y"); ?></h1>
<h1><div class="textbox"><div></h1><br>
<a id="stop" href="#">Stop</a>
<script type="text/javascript">
		var words = <?php echo json_encode($file); ?>;

			var getRandomWord = function () {
			  return words[Math.floor(Math.random() * words.length)];
			};
		$(function() { // after page load
		  var interval = setInterval(function(){
			$('.textbox').fadeOut(10, function(){
			  $(this).html(getRandomWord()).fadeIn(10);
			});
		  // 5 seconds
		  }, 100);
			$("#stop").click(function() {
				clearInterval(interval);
				$(this).hide();
				$.ajax({
					"url" : "take.php?name="+$('.textbox').html(),
					"success" : function(result){
						location.reload();
					}
				});
			});
		});
</script>
<?php }else{ ?>
<?php } ?>
<div id="data">
Result	: 
<ul>
</ul>
</div>
<script>
$.ajax({
	"url" : "data/<?php echo date('Ymd'); ?>.json",
	"success" : function(result){
		$.each(result,function(x,y){
			$('#data ul').append("<li>"+x+" ("+y+")</li>");
		});
	}	
});
</script>

