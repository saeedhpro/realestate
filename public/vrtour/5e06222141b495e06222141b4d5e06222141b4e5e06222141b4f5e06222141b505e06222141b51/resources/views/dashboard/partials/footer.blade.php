<footer class="footer">
    <div class="container-fluid">
        <nav class="float-left">
            <ul>
                <li>
                    <a href="https://www.ovinCode.ir">
                        تیم OvinCode.ir
                    </a>
                </li>
                <li>
                    <a href="https://www.ovinCode.ir/aboutus">
                        درباره OvinCode
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright float-right">
            &copy;
            <span id="date"></span>, ساخته شده توسط
            <a href="https://www.ovincode.ir" target="_blank">تیم OvinCode.ir</a>
            <i class="material-icons">favorite</i>
        </div>
    </div>
</footer>
</div>
</div>

<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/perfect-scrollbar.jquery.min.js') }}"></script>

<script src="{{ asset('js/dashboard/bootstrap-notify.js') }}"></script>

<script src="{{ asset('js/dashboard/material-dashboard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/rtl-js.js') }}"></script>

<script>
    $(document).ready(function () {
        md.initDashboardPageCharts();
        $("#date").html(new Date().getFullYear());
    });
</script>
@yield('scripts')
</body>

</html>
