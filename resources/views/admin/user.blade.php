@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<div class="card card-body">
    @if ($errors->any())
    	<div class="alert alert-danger" role="alert">
		<p class="fw-bolder text-gray-800 fs-6">Something Went Wrong</p>
        @foreach ($errors->all() as $error)
		<span style="color: rgb(187, 8, 8)" class="text-mute fw-bold d-block">{{$error}}</span>
    @endforeach	
		</div>
	@endif
    <div class="table-responsive">
        <table id="user_data" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Unit</th>
                    <th>Surat Penugasan</th>
                    <th>Edit</th>
                    <th>Password Baru</th>
                    <th>Konfirmasi Password Baru</th>
                    <th>Ganti Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>
                    <form action="{{route('edit-user')}}" method="post">
                        @csrf
                        <td>{{$u->name}}</td>
                        <td><input type="email" name="email" class="form-control w-auto" value="{{$u->email}}" /></td>
                        <td><input type="number" name="nip" class="form-control w-auto" value="{{$u->nip}}" /></td>
                        <td><input type="text" name="jabatan" class="form-control w-auto" value="{{$u->jabatan}}" /></td>
                        <td>
                            <div class="w-100">
                                <select name="unit" required class="form-select w-auto" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true">
                                    <option value="{{$u->unit}}">{{$u->unit}}</option>
                                    @foreach ($units->where('unit', '!=', $u->unit) as $unit)
                                    <option value="{{$unit->unit}}">{{$unit->unit}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td><a href="{{asset('storage/'.$user->surat)}}" class="badge badge-primary" >Lihat</a></td>
                        <input type="hidden" value="{{$u->id}}" name="user_id">
                        <td><button style="border: none" type="submit" class="badge badge-success" >Edit</button></td>
                    </form>
                    <form action="{{route('change-user-password')}}" method="post">
                        @csrf
                        <td><input class="form-control form-control-lg w-auto" type="password" name="password" required autocomplete="current-password" /></td>
                        <td><input class="form-control form-control-lg w-auto" type="password" name="password_confirmation" required autocomplete="current-password" /></td>
                        <td><button style="border: none" type="submit" class="badge badge-danger" >Ganti Password</button></td>
                        <input type="hidden" value="{{$u->id}}" name="user_id">
                    </form>
                </tr>
                @endforeach
            </tbody>
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