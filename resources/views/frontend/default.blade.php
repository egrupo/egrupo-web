@yield('content')
<!-- Section -->
<div class="section footer no-margin-top">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-5 copyright">
				<p>egrupo<br>
					por <a href="http://ruiesantos.com">Rui Santos</a></p>
			</div>
				<!-- Social icons -->
			<div class="col-md-6 col-sm-7 social-icons">
				<ul>
					<li><a href="http://twitter.com/egrupoapp" class="socicon">a</a></li>
					<li><a href="https://www.facebook.com/Egrupo-1633682853549265" class="socicon">b</a></li>
				</ul>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/headhesive.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/scrollme.min.js"></script>
	<script src="js/matchHeight.min.js"></script>
	<script src="js/flickity.js"></script>
	<script src="js/bootstrap-dropdown-on-hover.js"></script>
	<script src="js/custom.js"></script>
	<script type="text/javascript">
	$.ajaxSetup({
   		headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
	</script>
	</body>
</html>