<div>
    @forelse ($gurus as $key => $guru)
        <div>{{ $guru->nama }}</div>
    @empty
        <p>Guru tidak terdaftar.</p>
    @endforelse
</div>