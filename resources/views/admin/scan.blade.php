@extends('layouts.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tabler Icons</h5>
                            </div>
                        </div>
                        <div class="col-auto">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Icons</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabler Icons</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] start -->
            <div class="row d-flex justify-content-center">

                <!-- [ sample-page ] start -->

                <!-- Card dengan DataTable -->
                <div class="col-12 col-md-8 col-sm-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Table Example</h5>
                            <p class="text-muted mb-0">Showing data with search, pagination, and sorting.</p>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div id="reader" class="vh-80" style="height: 90%" width="600px"></div>
                            <iframe src="" style="width: 100%;display: none" class="vh-100" id="pembayaran"
                                frameborder="0"></iframe>

                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        // $(document).ready(function() {
        $('#tableTipe').DataTable();
        // });  
    </script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            $.ajax({
                type: "post",
                url: "{{ route('scan') }}",
                data: {
                    id: decodedText
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $("#pembayaran").css('display', '')
                        $("#pembayaran").css('width', '100%')
                        $('#pembayaran').attr('src', response.data.redirect_url)
                    } else {
                        swal("Perhatian", response.message, "warning");
                    }
                }
            });
            html5QrcodeScanner.clear()

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 400,
                    height: 400
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
