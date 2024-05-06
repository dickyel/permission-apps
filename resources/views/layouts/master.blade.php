<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; Arfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../vendor/perfect-scrollbar/css/perfect-scrollbar.css">
    <link href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/css/loading.css') }}">

    @stack('cssLibrary')

    <link rel="stylesheet" href="{{ asset('./assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/bootstrap-override.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/loading.css') }}">
    
    <link rel="stylesheet" id="theme-color" href="../assets/css/dark.min.css">

    @stack('css')
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        @include('layouts.header')
        @include('layouts.sidebar')
        
        <div class="modal fade" id="modal_action" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
          
        </div>

        {{ $slot }}
        
        @include('layouts.settings')

        <footer>
            Copyright © 2022 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1"> Mulai Dari Null </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>

        <!-- loader -->

        <div class="preloader" style="visibility:hidden;">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    @stack('jsLibrary')
    <script src="../assets/js/main.min.js"></script>
    <script>
        Main.init()

        showLoading()
        $(document).ready(function() {
            showLoading(false)
        })

        function showLoading(show = true) {
            const preloader = $(".preloader");

            if (show) {
                preloader.css({
                    opacity: 1,
                    visibility: "visible",
                });
            } else {
                preloader.css({
                    opacity: 0,
                    visibility: "hidden",
                });
            }
        }

    function submitLoader(formId = '#form_action') {
        const button = $(formId).find('button[type="submit"]');
        const originalHtml = button.html();

        function show() {
            button.addClass("btn-load").attr("disabled", true).html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
            );
        }

        function hide() {
            button.removeClass("btn-load").removeAttr("disabled").html(originalHtml);
        }

        return {
            show,
            hide
        };
    }

    </script>

    @stack('js')
</body>

</html>