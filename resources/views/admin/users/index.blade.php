@extends('layouts.admin')
@section('title', 'Manajemen Pengguna')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Pengguna</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah Pengguna Baru</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th><th>Username</th><th>Jabatan</th><th>Kantor</th><th>Level</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->jabatan }}</td>
                        <td>{{ $user->kode_kantor }}</td>
                        <td><span class="badge bg-danger text-capitalize">{{ $user->role }}</span></td>
                        <td><span class="badge bg-success text-capitalize">{{ $user->status }}</span></td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
