<!-- resources/views/kosan/manage.blade.php -->
<h1>Halaman Manajemen Kosan</h1>

<a href="{{ route('kosan.create') }}" class="btn btn-primary">Create Kosan</a>

@foreach ($kosans as $k)
    {{ $k->nama_kosan }}
    <form action="{{ route('kosan.destroy', $k->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@endforeach
