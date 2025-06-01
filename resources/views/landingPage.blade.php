<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PKL SIJA'26</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            cyprus: '#004643',
            sanddune: '#F0EDE5',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-sanddune text-cyprus">
    <header class="sticky top-0 z-50 bg-sanddune text-cyprus shadow-md">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
    <a href="/" class="text-xl font-bold">SIJA'26</a>
    <nav class="space-x-4">
      @if (Route::has('login'))
          @auth
              <a href="{{ url('/dashboard') }}" class="bg-cyprus text-sanddune px-4 py-2 rounded-md hover:bg-[#003d39] transition font-medium">
                    Dashboard
              </a>
          @else
              <a href="{{ route('login') }}" class="bg-cyprus text-sanddune px-4 py-2 rounded-md hover:bg-[#003d39] transition font-medium">
                    Login
              </a>
              @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-transparent border border-cyprus text-cyprus px-4 py-2 rounded-md hover:bg-cyprus hover:text-sanddune transition font-medium">
                    Register
                </a>
              @endif
          @endauth
      @endif
    </nav>
  </div>
</header>

  <!-- Hero Section -->
  <section class="bg-cyprus text-sanddune py-24 px-6 md:px-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
      <div>
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
        <br class="hidden md:block" />
          PKL JURUSAN SIJA 
        </h1>
        <p class="text-lg mb-8">
          Telusuri data siswa, guru, industri mitra, dan perkembangan kegiatan
        </p>

      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-20 px-6 md:px-16 bg-sanddune text-cyprus">
    <div class="max-w-7xl mx-auto text-center">
      <h2 class="text-3xl md:text-4xl font-semibold mb-4">Apa itu PKL?</h2>
      <p class="max-w-2xl mx-auto mb-12">
        Praktik Kerja Lapangan (PKL) adalah kegiatan belajar di dunia industri nyata 
        <br>
        yang dilakukan oleh siswa SMK untuk mengasah keterampilan sesuai jurusan masing-masing.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <h3 class="text-xl font-semibold mb-2">Simulasi Dunia Kerja</h3>
          <p>Siswa belajar langsung di lingkungan kerja profesional sesuai bidang keahlian.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <h3 class="text-xl font-semibold mb-2">Proyek Nyata</h3>
          <p>Mengikuti aktivitas dan proyek langsung di perusahaan, seperti pengembangan aplikasi, testing, atau deployment.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <h3 class="text-xl font-semibold mb-2">Kolaborasi & Komunikasi</h3>
          <p>Belajar bekerja dalam tim, mengikuti briefing, dan berkomunikasi dengan klien atau supervisor.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-20 bg-white px-6 md:px-16 text-cyprus">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="text-3xl font-semibold mb-12">Apa Saja Fitur Aplikasi ini?</h2>
      <div class="grid md:grid-cols-2 gap-10">
        <div class="bg-sanddune p-6 rounded-xl shadow-md">
          <p class="mb-4">Visualisasi data realtime tentang jumlah siswa yang sudah isi data PKL, yang belum, serta data industri dan jumlah peserta per industri.</p>
          <p class="font-bold">– Sangat keren bukan?</p>
        </div>
        <div class="bg-sanddune p-6 rounded-xl shadow-md">
          <p class="mb-4">Akses lengkap dan mudah untuk melihat, menambah, dan mengelola data siswa, guru pembimbing, dan industri mitra.</p>
          <p class="font-bold">– Canggih sekali!</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-cyprus text-sanddune py-10 border-t mt-10">
    <div class="max-w-7xl mx-auto px-6 md:px-16 flex flex-col md:flex-row justify-between items-center">
      <p class="text-sm">&copy; Aulia Maharani XII SIJA A</p>
      </div>
    </div>
  </footer>

</body>
</html>
