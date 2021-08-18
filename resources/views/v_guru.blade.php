@extends('layout.v_template')
@section('title','List Guru')
    



@section('content')
    @if (session('pesan'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success</h5>
        {{session('pesan')}}
      </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama Guru</th>
                <th>Jumlah Simpanan</th>
                <th>Foto</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            ?>
            @foreach ($guru as $data)
               <tr>
                   <td> {{$no++}} </td>
                   <td>{{$data->nip}}</td>
                   <td>{{$data->nama_guru}}</td>
                   <td>{{$data->mapel}}</td>
                   <td><img src=" {{ url('foto_guru/'.$data->foto_guru) }} "></td>
                   <td>
                       <a href="/guru/detail/ {{$data->id_guru}} " class="btn btn-sm btn-warning">Detail</a>
                       <a href="/guru/edit/{{$data->id_guru}}" class="btn btn-sm btn-success">Edit</a>
                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$data->id_guru}}">
                        Delete
                      </button
                   </td>
               </tr>
               
            @endforeach
            
        </tbody>
   </table>

@foreach ($guru as $data)
    
   <div class="modal fade" id="delete{{$data->id_guru}}">
    <div class="modal-dialog modal-sm">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">{{$data->nama_guru}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin untuk menghapus??</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
          <a href="/guru/delete/ {{$data->id_guru}}" type="button" class="btn btn-outline-light">Yes</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  @endforeach


   <a href="/guru/add" class="btn btn-primary btn-md">Tambah Data</a>
@endsection