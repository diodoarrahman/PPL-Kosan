<!-- resources/views/favorite/index.blade.php -->
<h1>Daftar Favorit</h1>
<ul>
    @foreach ($favorites as $favorite)
        <li>
            Kosan: {{ $favorite->kosan->nama_kosan }}
        </li>
    @endforeach
</ul>
