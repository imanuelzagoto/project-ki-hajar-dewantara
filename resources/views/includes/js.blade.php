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
    // Update the clock every second
    setInterval(updateClock, 1000);

    function updateClock() {
        var now = new Date();
        var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
            'November', 'Desember'
        ];

        // Set timezone to Asia/Jakarta
        var options = {
            timeZone: 'Asia/Jakarta',
            weekday: 'long'
        };
        var dayName = new Intl.DateTimeFormat('id-ID', options).format(now);

        var dateTimeString = '<i class="fas fa-calendar"></i>&nbsp;' + dayName + ', ' + now.getDate() + ' ' +
            months[now.getMonth()] + ' ' + now.getFullYear() + '&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;' +
            formatTime(now);
        document.getElementById('datetime').innerHTML = dateTimeString;
    }

    function formatTime(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        var strTime = hours + ':' + minutes + ':' + seconds;
        return strTime;
    }

    // Call updateClock initially to set the clock right away
    updateClock();
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Memastikan toggleIcon ada sebelum menambahkan event listener
        const togglePasswords = document.querySelectorAll('.toggle-password');
        togglePasswords.forEach(function(togglePassword) {
            togglePassword.addEventListener('click', function(e) {
                const passwordInput = document.querySelector('input[name="password"]');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' :
                    'password';
                passwordInput.setAttribute('type', type);

                // Toggle the eye icon class
                if (type === 'password') {
                    togglePassword.classList.remove('fa-eye-slash');
                    togglePassword.classList.add('fa-eye');
                } else {
                    togglePassword.classList.remove('fa-eye');
                    togglePassword.classList.add('fa-eye-slash');
                }
            });
        });

        // Menambahkan perilaku tooltip saat mouse diarahkan ke tombol
        const buttons = document.querySelectorAll('.tooltip-container');
        buttons.forEach(function(button) {
            const tooltip = button.querySelector('.tooltip-text');
            if (tooltip) {
                button.addEventListener('mouseover', function() {
                    tooltip.style.visibility = 'visible';
                    tooltip.style.opacity = '1';
                });

                button.addEventListener('mouseout', function() {
                    tooltip.style.visibility = 'hidden';
                    tooltip.style.opacity = '0';
                });

                // Memproses logout saat tombol di klik
                const logoutButton = button.querySelector('.button-logout');
                if (logoutButton) {
                    logoutButton.addEventListener('click', function() {
                        document.getElementById('logout-form').submit();
                    });
                }
            }
        });

    });
</script>
