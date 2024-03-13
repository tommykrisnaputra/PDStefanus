@if (session('message'))
	<div class="toast active" id="notification">
		<div class="toast-content">
			<div class="message">
				<span class="text text-1">Success!</span>
				{{ session('message') }}
			</div>
		</div>
		<div class="progress active"></div>
	</div>
	<script type="text/javascript">
		$('document').ready(function() {
			setTimeout(function() {
				$('.toast').remove();
			}, 2000);
		});
	</script>
@endif
