<!--   Core JS Files   -->
<script src="{{ asset('partas/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('partas/js/core/popper.min.js') }}"></script>
<script src="{{ asset('partas/js/core/bootstrap.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('partas/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('partas/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<!-- jQuery Scrollbar -->
<script src="{{ asset('partas/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('partas/js/plugin/chart.js/chart.min.js') }}"></script>
<!-- jQuery Sparkline -->
<script src="{{ asset('partas/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Chart Circle -->
<script src="{{ asset('partas/js/plugin/chart-circle/circles.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('partas/js/datatables.min.js') }}"></script>
{{-- <!-- Bootstrap Notify -->
<script src="{{ asset('partas/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}
<!-- jQuery Vector Maps -->
<script src="{{ asset('partas/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('partas/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('partas/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<!-- Atlantis JS -->
<script src="{{ asset('partas/js/atlantis.min.js') }}"></script>
<script src="{{ asset('partas/js/atlantis.js') }}"></script>
<script src="{{ asset('partas/js/plugin/webfont/webfont.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- sets/public --}}
<script src="{{ asset('sets/js/jam.js') }}"></script>
<script src="{{ asset('sets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('sets/js/icons/feather-icon/feather-icon.js') }}"></script>
<script src="{{ asset('sets/js/config.js') }}"></script>
<script src="{{ asset('sets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('sets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('sets/js/script.js') }}"></script>


<script>
    // Function to update page title
    function updateTitle(newTitle) {
        document.title = "{{ config('app.name') }} | " + newTitle;
    }

    // Event listener for menu item clicks
    $('.nav-link').click(function(e) {
        e.preventDefault();
        var menuItem = $(this).find('p').text().trim();
        updateTitle(menuItem);
    });
</script>
