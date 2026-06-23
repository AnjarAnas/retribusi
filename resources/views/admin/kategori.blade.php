@extends('layouts.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Kategori</h5>
                            </div>
                        </div>
                        <div class="col-auto">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Kategori</a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">Tabler Icons</li> --}}
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
                            <h5>Kategori Retribusi</h5>
                            <p class="text-muted mb-0">Data yang ditampilkan daftar kategori yang tersedia</p>
                        </div>
                        <div class="card-body">
                            <button data-bs-toggle="modal" id="tambah" data-bs-target="#staticBackdrop"
                                class="btn btn-info mb-4 rounded btn-sm"><i class="ti ti-plus"></i> Tambah</button>
                            <table id="tableKategori" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $item)
                                        <tr>
                                            <td>{{ $item->uuid }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>
                                                <button id="edit" class="btn btn-warning btn-sm rounded"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                    data-uuid="{{ $item->uuid }}" data-desa="{{ $item->desa_id }}"
                                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                    data-alamat="{{ $item->alamat }}"><i
                                                        class="ti ti-pencil"></i>Edit</button>
                                                <button class="btn btn-danger rounded btn-sm"><i
                                                        class="ti ti-trash"></i>Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submitForm" class="formtambah">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="tipe" name="tipe">
                        <div class="form-group mb-2">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group mb-2">
                            <label for="nama" class="form-label">Desa</label>
                            <select name="desa_id" class="form-control" id="desa_id">
                                <option value="">--Pilih Opsi--</option>
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="alamat" class="form-label">Alamat Kategori</label>
                            <textarea class="form-control" name="alamat" id="alamat1" placeholder="Alamat" cols="30" rows="10"></textarea>
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
        $(document).ready(function() {
            $('#tableKategori').DataTable();
        });

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
            $("#alamat1").val(data.data('alamat'))
            $(`#desa_id option[value='${data.data('desa')}']`).prop("selected", true);
            $("#tipe").val("edit")
        });

        function reset() {
            $("#nama").val("")
            $("#id").val(" ")
            $("#alamat1").val(" ")
        }
        $("#tambah").click(function(e) {
            e.preventDefault();
            reset()
            $("#tipe").val("tambah")

        });
        $("#submitForm").submit(function(e) {
            e.preventDefault();
            const tipe = $("#tipe").val()
            if (tipe === "tambah") {
                $.ajax({
                    type: "post",
                    url: "{{ route('kategori.store') }}",
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
                    url: "/kategori/" + $('#id').val(),
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
    </script>
@endsection
