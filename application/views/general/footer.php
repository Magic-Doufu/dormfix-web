        </div>
        <div class="container-fluid btn-top hidden">
            <div class="row col-md-8 col-md-offset-2 pd-0">
                <button top class="btn btn-warning btn-square btn-block" onclick="gototop()">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                    <span class="text-important">回到頂端</span>
                </button>
            </div>
        </div>
        <footer class="footer-cpr bkg-black-50 z-100">
            <span class="text-white mg-h-2">M.T.P.T. in A.S.D. &copy; 2017 歡迎來信至：gtrx8fd3ds@gmail.com</span>
        </footer>
        <script type="text/javascript">
            window.onscroll = function() {scrollTest()};
            unit = $('html').css('font-size');
            function scrollTest() {
                if ($('html').scrollTop() > 20) {
                    $('button[top]').first().removeClass('hidden');
                } else {
                    $('button[top]').first().addClass('hidden');
                }
            }
            function gototop() {
                $('html').animate({scrollTop:0}, 'fast');
            }
        </script>
    </body>
</html>