 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
    <div class="copyright">
      &copy;2023 - Copyright <strong><span>Data Base Relawan MHF</span></strong>
    </div>
    <div class="credits">
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets_dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets_dashboard/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets_dashboard/jquery/jquery.js') }}"></script>

  {{-- old script use updated script because datatable is not a function --}}
  {{-- <script src="{{ asset('assets_dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}

  <!-- Template Main JS File -->
  <script src="{{ asset('assets_dashboard/js/main.js') }}"></script>
  <script src="{{ asset('assets_dashboard/vendor/SwetAlert/index.js') }}"></script>
  {{-- <script src="https://unpkg.com/@googlemaps/js-api-loader@1.x/dist/index.min.js"></script> --}}
    {{-- <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "{{ env('credential_google') }}", v: "weekly"});</script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('credential_google') }}&libraries=places&callback=initMap" async defer></script> --}}

   {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  --}}

  @stack('js')

<script>
    $(document).ready(function () {
        // Fungsi untuk mengganti console.log dan console.error
        function disableXHRLogging() {
            console.log = function() {};
            console.error = function() {};
        }
        $(".delete").on('click', function (e){
            slug = e.target.dataset.id;
            e.preventDefault();
            swal({
                    title: 'Anda yakin?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(`#delete-${slug}`).submit();
                    }else {
                        //do nothing
                    }
            });
        });
    });
</script>
