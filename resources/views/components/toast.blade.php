<!-- resources/views/auth/mhs-login.blade.php -->
<form action="{{ route('login.mahasiswa') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nama:</label>
        <input type="text" name="name" placeholder="Nama" required>
    </div>

    <div>
        <label for="nim">NIM:</label>
        <input type="text" name="nim" placeholder="NIM" required>
    </div>

    <button type="submit">Login Mahasiswa</button>
</form>

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
