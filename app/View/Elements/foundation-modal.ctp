<style>
.reveal-modal{
	background: none repeat scroll 0 0 black;
    color: white;
    font-weight: normal;
}
.white-modal
{
	background: none repeat scroll 0 0 white !important;
    color: black !important;
}
.message
{
	text-align:center;
}
</style>
<script>
	$(document).ready(function(){
		var flashMessage = '<?php echo $this->Session->flash(); ?>';
		if(flashMessage.length > 0)
		{
			$('#flashMessage').html("" + flashMessage + $('#flashMessage').html());
			$('#flashMessage').foundation('reveal', 'open');
		}

		$('#CloseFlashMessage').click(function(){
			$('#flashMessage').foundation('reveal', 'close');
		});
	});
</script>

<div id="flashMessage" class="reveal-modal small">
	<br/>
  	<a class="close-reveal-modal">&#215;</a>
  	<a id="CloseFlashMessage" class="small button joyride-next-tip" href="#"><?php echo __('Cerrar'); ?></a>
</div>