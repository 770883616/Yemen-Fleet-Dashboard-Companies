<!-- jquery -->
<script src="{{ URL::asset('public/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('public/assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('public/assets/js') }}/';</script>

<!-- chart -->
<script src="{{ URL::asset('public/assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('public/assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('public/assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('public/assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('public/assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('public/assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('public/assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('public/assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('public/assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('public/assets/js/custom.js') }}"></script>

<!-- إضافة Toastr JS في أسفل الصفحة قبل إغلاق الـ </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>



@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif
