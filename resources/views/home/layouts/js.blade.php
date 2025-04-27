<script src="{{ asset('assets/home/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/lightcase.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/donate-range.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/wow.js') }}"></script>
<script src="{{ asset('assets/home/assets/js/custom.js') }}"></script>
<!-- jQuery Library -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script> <!-- jQuery first -->

<!-- jQuery Validation Plugin -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> --}}
<script src="{{ asset('assets/modules/jquery.validate.min.js') }}"></script> <!-- jQuery Validation first -->



<!-- External JS Libraries (Make sure jQuery is first) -->
{{-- <script src="{{ asset('assets/modules/jquery.min.js') }}"></script> <!-- jQuery first --> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
{{-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> <!-- This should be included --> --}}

<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Libraries -->
<script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/index.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Toastr and IziToast Libraries -->
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>

<!-- SweetAlert -->
<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>

<!-- Form & Datepicker Libraries -->
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/page/components-user.js') }}"></script>
<script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

{{-- Use @push('script') to add additional JS dynamically --}}
@stack('script')
