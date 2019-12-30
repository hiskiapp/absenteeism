<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script>
	$(function() {
		'use strict';
		$('#main-wrapper').AdminSettings({
		    Theme: false, // this can be true or false ( true means dark and false means light ),
		    Layout: 'vertical',
		    LogoBg: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
		    NavbarBg: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
		    @if(empty($sidebar_type))
		    SidebarType: 'full', // You can change it full / mini-sidebar / iconbar / overlay
		    @else
		    SidebarType: '{{ $sidebar_type}}', // You can change it full / mini-sidebar / iconbar / overlay
		    @endif
		    SidebarColor: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
		    SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
		    HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
		    BoxedLayout: false // it can be true / false ( true means Boxed and false means Fluid )
		});
	});

	function logout(){
		$('#logout').modal('show');
	}
</script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<!--This page JavaScript -->
@stack('bottom')