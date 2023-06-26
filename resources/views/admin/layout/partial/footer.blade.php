
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">
                {{awtTrans('حقوق النشر')}} &copy; {{\Carbon\Carbon::now()->year}}
                <a class="text-bold-800 grey darken-2" href="https://aait.sa/" target="_blank">,</a>
                {{awtTrans('كل الحقوق محفوظة')}}
            </span>
            <span class="float-md-right d-none d-md-block"> 
                <a href="https://aait.sa/" rel="follow" target="_blank">{{awtTrans('أوامر الشبكة')}}</a>
                <a href="mailto:sales@aait.sa" ><i class="feather icon-mail pink"></i></a> 
                <a href="tel:920005929" ><i class="feather icon-phone pink"></i></a> 
            </span>
        </p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->

    <script src="{{asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script>
        // "(filtered from _MAX_ total records)"
        var zeroRecordsText = '{{awtTrans("لا يوجد بيانات مطابقة لبحثك")}}'
        var SearchText = '{{awtTrans("بحث")}}'
        var lengthMenuText1 = '{{awtTrans("عرض")}}'
        var lengthMenuText2 = '{{awtTrans("مدخل")}}'
        var nextText = '{{awtTrans("التالي")}}'
        var previousText = '{{awtTrans("السابق")}}'
        var copyText = '{{awtTrans("نسخ")}}'
        var printText = '{{awtTrans("طباعة")}}'
        var jsonText = '{{awtTrans("جيسون")}}'
 
    </script>
    @yield('js')
    <x-admin.alert />
</body>
</html>