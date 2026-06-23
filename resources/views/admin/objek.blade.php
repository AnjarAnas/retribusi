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
            <div class="row">
                <!-- [ sample-page ] start -->

                <!-- Card dengan DataTable -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Table Example</h5>
                            <p class="text-muted mb-0">Showing data with search, pagination, and sorting.</p>
                        </div>
                        <div class="card-body">
                            <table id="tableTipe" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 300px">UUID</th>
                                        <th>Info Pemilik</th>
                                        <th>Jenis</th>
                                        <th style="width: 190px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objek as $item)
                                        <tr>
                                            <td>{{ $item->uuid }}</td>
                                            <td>{{ $item->nama }}<br><b>{{ $item->nama_pemilik }}</b></td>
                                            <td><span>{{ $item->tipe->nama }}</span><br><span><b>{{ $item->kategori->nama }}</b></span>
                                            </td>
                                            <td><button class="btn btn-warning btn-sm rounded"><i
                                                        class="ti ti-pencil"></i>Edit</button><button
                                                    class="btn btn-danger btn-sm rounded" style="margin-left: 5px"><i
                                                        class="ti ti-trash"></i>Hapus</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>UUID</th>
                                        <th>Info Pemilik</th>
                                        <th>Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>

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
@endsection
