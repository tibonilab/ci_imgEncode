<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IMG Crypt</title>
</head>
<body oncontextmenu="return false">
	<img class="img-crypt" draggable="false" data-rel="<?php echo base64_encode(FCPATH . 'test-image.jpg') ?>" data-time="<?php echo microtime(true) ?>"/>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>

var base_url = '<?php echo base_url() ?>';

$().ready(function () {

	$.each($('.img-crypt'), function() {

		var me = $(this);

		var params = {
			url: base_url + 'ajax/img',
			data: {rel: me.data('rel')},
			type: 'POST'
		};
		
		$.ajax(params).done(function (r) {
			me.attr('src', r);
		})

	})
	
	$('.img-crypt').on('dragstart', function(event) { event.preventDefault(); });

})

</script>
</html>