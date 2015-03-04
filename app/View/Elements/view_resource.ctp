<style type="text/css">
#blocker
{
	opacity: 0.0;
	position:absolute;
   	left:0;
   	right:0;
   	top:0;
   	bottom:0;
   	width:88%;
   	height:88%;
   	margin:auto;
}

</style>

<div id="blocker"></div>
<iframe id="document" src="<?php echo $resource['Resource']['url']; ?>" width="100%" height="700"></iframe>

<script type="text/javascript">
	$(document).ready(function(){

		$("#blocker").scroll(function() {
		 console.log('scroll');
		});

		$('#blocker').bind('contextmenu', function(e) {
		    return false;
		});
		
	});
</script>