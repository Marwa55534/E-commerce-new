 <!-- BEGIN VENDOR JS-->
 <script src="{{asset('assets/dashboard')}}/vendors/js/vendors.min.js" type="text/javascript"></script>
 <!-- BEGIN VENDOR JS-->
 <!-- BEGIN PAGE VENDOR JS-->
 <script src="{{asset('assets/dashboard')}}/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
 <script src="{{asset('assets/dashboard')}}/vendors/js/charts/chartist-plugin-tooltip.min.js"
 type="text/javascript"></script>
 <script src="{{asset('assets/dashboard')}}/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
 <script src="{{asset('assets/dashboard')}}/vendors/js/charts/morris.min.js" type="text/javascript"></script>
 <script src="{{asset('assets/dashboard')}}/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
 <!-- END PAGE VENDOR JS-->
 <!-- BEGIN MODERN JS-->
 <script src="{{asset('assets/dashboard')}}/js/core/app-menu.js" type="text/javascript"></script>
 <script src="{{asset('assets/dashboard')}}/js/core/app.js" type="text/javascript"></script>
 <script src="{{asset('assets/dashboard')}}/js/scripts/customizer.js" type="text/javascript"></script>
 <!-- END MODERN JS-->
 <!-- BEGIN PAGE LEVEL JS-->
 <script src="{{asset('assets/dashboard')}}/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script>
 <!-- END PAGE LEVEL JS-->

{{-- sweetalert2 --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
    let title = "{{ __('dashboard.Are_you_sure') }}";
    let title_deleted = "{{ __('dashboard.deleted') }}";
    let text_deleted = "{{ __('dashboard.has_been_deleted') }}";
    let text_revert = "{{ __('dashboard.revert_this') }}";
    let confirmButtonText = "{{ __('dashboard.confirm_button_text') }}";
    let cancelButtonText = "{{ __('dashboard.cancel_button_text') }}";
    let Cancelled = "{{ __('dashboard.cancelled') }}";
    let file_is_safe = "{{ __('dashboard.file_is_safe') }}";


    $(document).on('click' , '.delete_comfirm' , function(e){
        e.preventDefault();
        form = $(this).closest('form');
        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
  },
  buttonsStyling: true
});
swalWithBootstrapButtons.fire({
  title: title,
  text: text_revert,
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: confirmButtonText,
  cancelButtonText: cancelButtonText,
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    form.submit();
    swalWithBootstrapButtons.fire({
      title: title_deleted,
      text: text_deleted,
      icon: "success"
    });
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire({
      title: Cancelled,
      text: file_is_safe,
      icon: "error"
    });
  }
});
    });
 </script>
{{--end sweetalert2 --}}


{{-- datatabel --}}
{{-- bootstrap 5--}}
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
{{-- buttons --}}
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
{{-- print --}}
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
{{-- excel --}}
<script src="{{asset('vendor/datatabels/excel/jszip.min.js')}}"></script>
{{-- pdf --}}
<script src="{{asset('vendor/datatabels/pdf/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/datatabels/pdf/vfs_fonts.js')}}"></script>
{{-- responsive --}}
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.min.js"></script>
{{-- ColReorder --}}
<script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/2.0.4/js/colReorder.bootstrap5.min.js"></script>
{{-- RowReorder --}}
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.bootstrap5.min.js"></script>
{{-- Select --}}
<script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/select/2.1.0/js/select.bootstrap5.min.js"></script>
{{-- FixedHeader --}}
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.bootstrap5.min.js"></script>
{{-- Scroller --}}
<script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.4.3/js/scroller.bootstrap5.min.js"></script>

{{--end datatabel --}}

{{-- file-input --}}
<script src="{{ asset('vendor/file-input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('vendor/file-input/themes/fa5/theme.min.js') }}"></script>

{{-- summernote --}}
<script scr="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>

@if(Config::get('app.locale') == 'ar')
<script src="{{ asset('vendor/file-input/js/locales/LANG.js') }}"></script>
<script src="{{ asset('vendor/file-input/js/locales/ar.js') }}"></script>
@endif

<script>
  var lang = "{{ app()->getLocale() }}";
  // plugin
  $(function(){ 
      $("#single-image").fileinput({
          theme: 'fa5',
          language: lang,
          allowedFileTypes: ['image'], 
          maxFileCount: 1,
          enableResumableUpload: false, 
          showUpload: false,
      });
  });


</script>
{{--end file-input --}}