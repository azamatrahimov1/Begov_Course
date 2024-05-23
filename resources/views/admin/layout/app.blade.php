<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Ingiliz tili kurslari / biz bilan juda oson / Begov</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/fonts/boxicons.css') }}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/css/core.css') }}" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/css/theme-default.css') }}"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/demo.css') }}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"/>

    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/libs/apex-charts/apex-charts.css') }}"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin_assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin_assets/js/config.js') }}"></script>

    <!-- Summernote  -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('admin.layout.menu')

        @include('admin.layout.layout_page')

    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin_assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin_assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->


<!-- Vendors JS -->
<script src="{{ asset('admin_assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('admin_assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('admin_assets/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Tinymce and Summernote  -->
<script src="https://cdn.tiny.cloud/1/6tkwzfbd3kc2np3xokig457z8q903geqlmakie71kn2hvueh/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- ajax jquery  -->
<script src="http://ajax.gooleapis.com/alax/libs/jquery/3.6.6/jquery.min.js"></script>

<script>
    $('#tinymce').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>

<!-- Pusher Notification -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('05beb96fd0f4c0e32cec', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel-p');

    channel.bind('my-event-p', function(data) {
        var toastTitle = document.getElementById('toastTitle');
        var toastBody = document.getElementById('toastBody');
        var toastElement = document.getElementById('myToast');

        if (data && data.message && data.message.full_name && data.message.desc) {
            toastTitle.textContent = data.message.full_name;
            toastBody.textContent = data.message.desc;

            var toast = new bootstrap.Toast(toastElement, {
                autohide: false
            });
            toast.show();

        } else {
            console.error("Invalid data structure received from Pusher:", data);
        }
    });
</script>

@yield('script')

</body>
</html>
