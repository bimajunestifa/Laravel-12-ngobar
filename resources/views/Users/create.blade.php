@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Tambah Pengguna Baru</h4>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="siswa">Siswa</option>
            </select>
        </div>
        <div class="mb-3" id="nis-field" style="display: none;">
            <label>NIS (Nomor Induk Siswa)</label>
            <input type="text" name="nis" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.querySelector('select[name="role"]');
        const nisField = document.getElementById('nis-field');
        
        roleSelect.addEventListener('change', function() {
            if (this.value === 'siswa') {
                nisField.style.display = 'block';
                nisField.querySelector('input').required = true;
            } else {
                nisField.style.display = 'none';
                nisField.querySelector('input').required = false;
            }
        });
    });
</script>
@endsection
