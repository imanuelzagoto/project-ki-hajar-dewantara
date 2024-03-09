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
<!-- Bootstrap Notify -->
<script src="{{ asset('partas/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<!-- jQuery Vector Maps -->
<script src="{{ asset('partas/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('partas/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('partas/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<!-- Atlantis JS -->
<script src="{{ asset('partas/js/atlantis.min.js') }}"></script>
<script src="{{ asset('partas/js/atlantis.js') }}"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ asset('partas/js/setting-demo.js') }}"></script>
<script src="{{ asset('partaz/js/jam.js') }}"></script>
<script src="{{ asset('partas/js/demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
{{-- <script src="{{ asset('helper-master/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('helper-master/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> --}}
<script>
    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: 60,
        maxValue: 100,
        width: 7,
        text: 5,
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: 70,
        maxValue: 100,
        width: 7,
        text: 36,
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: 40,
        maxValue: 100,
        width: 7,
        text: 12,
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets: [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>



{{-- JS LOGIN --}}
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script src="{{ 'partaz/js/icons/feather-icon/feather.min.js' }}"></script>
<script src="{{ 'partaz/js/icons/feather-icon/feather-icon.js' }}"></script>
<script src="{{ 'partaz/js/sidebar-menu.js' }}"></script>
<script src="{{ 'partaz/js/config.js' }}"></script>
<script src="{{ 'partaz/js/bootstrap/popper.min.js' }}"></script>
<script src="{{ 'partaz/js/bootstrap/bootstrap.min.js' }}"></script>
<script src="{{ 'partaz/js/script.js' }}"></script>


<script>
    const togglePassword = document.querySelector('#toggleIcon');
    const passwordInput = document.querySelector('input[name="password"]');

    togglePassword.addEventListener('click', function(e) {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon
        if (type === 'password') {
            togglePassword.classList.remove('data-feather', 'eye-off');
            togglePassword.classList.add('data-feather', 'eye');
        } else {
            togglePassword.classList.remove('data-feather', 'eye');
            togglePassword.classList.add('data-feather', 'eye-off');
        }
    });
</script>
