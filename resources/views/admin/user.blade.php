@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<div class="card card-body">
    <div class="table-responsive">
        <table id="user_data" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Unit</th>
                    <th>Edit</th>
                    <th>Password Baru</th>
                    <th>Konfirmasi Password Baru</th>
                    <th>Ganti Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="post">
                        <td>1</td>
                        <td>Balmond Odette</td>
                        <td><input type="email" name="email" class="form-control" value="balmond@gmail.com" /></td>
                        <td><input type="number" name="nip" class="form-control" value="12345678" /></td>
                        <td><input type="text" name="jabatan" class="form-control" value="Manager" /></td>
                        <td>
                            <div class="w-100">
                                <select name="unit" required class="form-select" data-control="select2" data-placeholder="-" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="select2-data-18-0jcq"></option>
                                    <option value="kesehatan">Kesehatan</option>
                                    <option value="pendidikan">Pendidikan</option>
                                </select>
                            </div>
                        </td>
                        <td><a type="submit" class="badge badge-success" >Edit</a></td>
                    </form>
                    <form action="/ganti_password?id=" method="post">
                        <td><input class="form-control form-control-lg" type="password" name="password_baru" required autocomplete="current-password" /></td>
                        <td><input class="form-control form-control-lg" type="password" name="confirm_password_baru" required autocomplete="current-password" /></td>
                        <td><a type="submit" class="badge badge-danger" >Ganti Password</a></td>
                    </form>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td><b>Add</b></td>
                    <form action="" method="post">
                        <td><input type="text" name="nama" class="form-control" /></td>
                        <td><input type="email" name="email" class="form-control" /></td>
                        <td><input type="number" name="nip" class="form-control" value="12345678" /></td>
                        <td><input type="text" name="jabatan" class="form-control" value="Manager" /></td>
                        <td>
                            <div class="w-100">
                                <select name="unit" required class="form-select" data-control="select2" data-placeholder="-" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="select2-data-18-0jcq"></option>
                                    <option value="kesehatan">Kesehatan</option>
                                    <option value="pendidikan">Pendidikan</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <select name="role" class="form-select" data-control="select2" data-placeholder="Role" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
                                <option value="" data-select2-id="select2-data-18-0jcq"></option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </td>
                        <td><input class="form-control form-control-lg" type="password" name="password_baru" required autocomplete="current-password" /></td>
                        <td><input class="form-control form-control-lg" type="password" name="confirm_password_baru" required autocomplete="current-password" /></td>
                        <td><a type="submit" class="badge badge-primary" >Tambah User</a></td>
                    </form>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $("#user_data").DataTable({
 "language": {
  "lengthMenu": "Show _MENU_",
 },
 "dom":
  "<'row'" +
  "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
  "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
  ">" +

  "<'table-responsive'tr>" +

  "<'row'" +
  "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
  "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
  ">"
});
</script>

@endsection('isi_halaman')