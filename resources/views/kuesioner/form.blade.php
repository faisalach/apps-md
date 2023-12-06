@include('layout.header')
    
    @if (Session::has('url_open'))
    <script>
        window.open("{{ Session::get('url_open') }}","_blank")
    </script>
    @endif
    <div style="background-image: url('/assets/bg1.jpg')" class="min-h-screen bg-repeat-y bg-contain p-4">
        <form action="{{ route('kuesioner.formStore') }}" method="POST">
            @csrf
            <div class="w-md bg-[#AAD2FF] p-3 rounded-xl max-w-full w-[920px] m-auto px-8 py-4">
                <div class="text-center mb-10">
                    <h1 class="text-4xl leading-tight font-bold">Form Test</h1>
                    <h1 class="text-4xl leading-tight font-bold"><span class="text-[#008000]">Apps</span><span class="text-white">MD</span> <span class="text-[#0000ff]">& Gaya Belajar</span></h1>
                    <h3 class="text-xl leading-tight mt-2 font-semibold italic ">Aplikasi Mengenal Diri</h3>
                </div>
                @if (Session::has('message'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {{ Session::get("message") }}
                </div>
                @endif
                <div class="mb-3">
                    <h5 class="font-semibold ml-6 mb-3"><span class="text-lg">FORM 1</span> <span class="text-sm">KET : <span class="text-red-500 italic">* WAJIB DIISI</span></span></h5>
                    <input type="hidden" name="no_peserta" value="{{ $no_peserta }}">
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="nama_lengkap" class="text-xs uppercase font-semibold">Nama Lengkap*</label>
                        <input type="text" required id="nama_lengkap" name="nama_lengkap" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Nama Lengkap">
                    </div>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="agama" class="text-xs uppercase font-semibold">Agama*</label>
                        <input type="text" required id="agama" name="agama" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Agama">
                    </div>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label class="text-xs uppercase font-semibold">Jenis Kelamin*</label>
                        <div class="flex items-center mt-4 mb-2">
                            <input id="laki-laki" required type="radio" value="laki-laki" name="jenis_kelamin" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="laki-laki" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">Laki-laki</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input id="perempuan" type="radio" value="perempuan" name="jenis_kelamin" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="perempuan" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">Perempuan</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white rounded-lg py-3 px-5 mb-3">
                            <label for="tempat_lahir" class="text-xs uppercase font-semibold">Tempat Lahir*</label>
                            <input type="text" required id="tempat_lahir" name="tempat_lahir" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Tempat Lahir">
                        </div>
                        <div class="bg-white rounded-lg py-3 px-5 mb-3">
                            <label for="tanggal_lahir" class="text-xs uppercase font-semibold">Tanggal Lahir*</label>
                            <input type="date" required id="tanggal_lahir" name="tanggal_lahir" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label class="text-xs uppercase font-semibold">Golongan Darah</label>
                        <div class="flex items-center mt-4 mb-2">
                            <input id="gol_a" type="radio" value="A" name="golongan_darah" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="gol_a" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">A</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input id="gol_b" type="radio" value="B" name="golongan_darah" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="gol_b" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">B</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input id="gol_ab" type="radio" value="AB" name="golongan_darah" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="gol_ab" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">AB</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input id="gol_o" type="radio" value="O" name="golongan_darah" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="gol_o" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">O</label>
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <h5 class="font-semibold ml-6 mb-3"><span class="text-lg">FORM 2</span></h5>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="alamat" class="text-xs uppercase font-semibold">Alamat *</label>
                        <input type="text" required id="alamat" name="alamat" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Alamat">
                    </div>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="email" class="text-xs uppercase font-semibold">Email *</label>
                        <input type="email" required id="email" name="email" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Email">
                    </div>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="no_wa" class="text-xs uppercase font-semibold">No Telepon / WA *</label>
                        <input type="text" required id="no_wa" name="no_wa" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan No. Telp / WA">
                    </div>
                </div>
                <div class="mb-3">
                    <h5 class="font-semibold ml-6 mb-3"><span class="text-lg">FORM TEST GAYA BELAJAR</span></h5>

                    @foreach($bank_soal as $number => $soal)
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label class="text-md uppercase font-semibold">{{ $number+1 }}. {{ $soal->pertanyaan }} :</label>
                        <div class="mt-4">
                            @foreach($soal->bank_soal_jawaban as $key => $jwb)
                            <div class="flex items-center mt-4 mb-2">
                                <input id="jwb_{{ $jwb->id }}" {{ $key == 0 ? "required" : "" }} type="radio" value="{{ $jwb->id }}" name="jawaban[{{ $jwb->bank_soal_id }}]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="jwb_{{ $jwb->id }}" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                                    @switch($key)
                                        @case(0)
                                            A.
                                            @break
                                        @case(1)
                                            B.
                                            @break
                                        @case(2)
                                            C.
                                            @break
                                    @endswitch
                                    {{ ucfirst($jwb->jawaban) }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class=" w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Kirim</button>
            </div>
        </form>
    </div>
@include('layout.footer')