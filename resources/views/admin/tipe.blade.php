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
                            <button data-bs-toggle="modal" id="tambah" data-bs-target="#staticBackdrop"
                                class="btn btn-info mb-4 rounded btn-sm"><i class="ti ti-plus"></i> Tambah</button>
                            <table id="tableKategori" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipe as $item)
                                        <tr>
                                            <td>{{ $item->uuid }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>Rp.{{ number_format($item->harga) }}</td>
                                            <td>
                                                <button id="edit" data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" data-nama="{{ $item->nama }}"
                                                    data-harga="{{ $item->harga }}"
                                                    class="btn btn-warning btn-sm rounded"><i
                                                        class="ti ti-pencil"></i>Edit</button>
                                                <button data-uuid="{{ $item->uuid }}" id="delete"
                                                    class="btn btn-danger rounded btn-sm"><i
                                                        class="ti ti-trash"></i>Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>Harga</th>
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Tipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submitForm" class="formtambah">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="tipe" name="tipe">
                        <div class="form-group mb-2">
                            <label for="nama" class="form-label">Nama Tipe</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label for="harga" class="form-label">Harga Kategori</label>
                            <input type="text" name="harga" id="harga" placeholder="Harga" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const table = $('#tableKategori').DataTable();

        function reload() {
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
        $("tr td").on("click", "#edit", function() {
            const data = $(this)
            reset()
            $("#nama").val(data.data('nama'))
            $("#id").val(data.data('id'))
            $("#harga").val(data.data('harga'))
            $("#tipe").val("edit")
            $("#staticBackdropLabel").html("Edit Tipe")
        });

        function reset() {
            $("#nama").val("")
            $("#id").val(" ")
            $("#harga").val(" ")
        }
        $("#tambah").click(function(e) {
            e.preventDefault();
            reset()
            $("#tipe").val("tambah")
            $("#staticBackdropLabel").html("Tambah Tipe")


        });
        $("#submitForm").submit(function(e) {
            e.preventDefault();
            const tipe = $("#tipe").val()
            if (tipe === "tambah") {
                $.ajax({
                    type: "post",
                    url: "{{ route('tipe.store') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            reload()
                            swal("Berhasil", response.message, "success");
                        } else {
                            swal("Perhatian", response.message, "warning");
                        }
                    }
                });
            } else {
                $.ajax({
                    type: "PUT",
                    url: "/tipe/" + $('#id').val(),
                    data: $(this).serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            reload()
                            swal("Berhasil", response.message, "success");
                        } else {
                            swal("Perhatian", response.message, "warning");
                        }
                    }
                });
            }
        });
        $("tr td").on("click", "#delete", function() {
            const id = $(this).data('uuid')
            swal({
                    title: "Apa Anda Yakin?",
                    text: "Check kembali data anda!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "delete",
                            url: "/tipe/" + id,
                            data: {},
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    swal(response.message, {
                                        icon: "success",
                                    });
                                    reload()
                                }
                            }
                        });

                    }
                });
        });
    </script>
@endsection
