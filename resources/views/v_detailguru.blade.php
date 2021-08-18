@extends('layout.v_template')
@section('title','Detail Guru')

@section('content')
    
<table class="table">
    <tr>
        <th width="200px">NIP</th>
        <th width="30px"> : </th>
        <th> {{$guru->nip}} </th>
    </tr>
    <tr>
        <th>Nama Guru</th>
        <th> : </th>
        <th> {{$guru->nama_guru}} </th>
    </tr>
    <tr>
        <th>Jumlah Simpanan</th>
        <th> : </th>
        <th> {{$guru->mapel}} </th>
    </tr>
    <tr>
        <th>Foto Guru</th>
        <th> : </th>
        <th> {{$guru->foto_guru}} </th>
    </tr>
    
        
    
</table>
<a href="/guru" class="btn btn-success "> Kembali </a>
@endsection