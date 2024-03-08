<footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto" id="highlight">
            @Ki-HajarDewantara
        </div>
    </div>
</footer>

<script type='text/javascript'>
    var text = "Kihajar dewantara";
    var speed = 150;

    var storetext = document.getElementById ? document.getElementById("highlight") : document.all.highlight;
    var hex = ["99", "14", "28", "3C", "50", "64", "78", "8C", "A0", "B4", "C8", "DC", "F0", "4D"];
    var r = 1,
        g = 1,
        b = 1,
        seq = 1;

    function changetext() {
        var rainbow = "#" + hex[r] + hex[g] + hex[b];
        storetext.style.color = rainbow;
    }

    function change() {
        if (seq == 6) {
            b--;
            if (b == 0)
                seq = 1;
        }
        if (seq == 5) {
            r++;
            if (r == 12)
                seq = 6;
        }
        if (seq == 4) {
            g--;
            if (g == 0)
                seq = 5;
        }
        if (seq == 3) {
            b++;
            if (b == 12)
                seq = 4;
        }
        if (seq == 2) {
            r--;
            if (r == 0)
                seq = 3;
        }
        if (seq == 1) {
            g++;
            if (g == 12)
                seq = 2;
        }
        changetext();
    }

    function starteffect() {
        flash = setInterval(change, speed);
    }

    starteffect();
</script>
