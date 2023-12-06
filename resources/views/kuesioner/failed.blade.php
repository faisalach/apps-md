@include('layout.header')
    
    <div style="background-image: url('/assets/bg1.jpg')" class="min-h-screen bg-repeat-y bg-cover p-4">
        <div class="w-md bg-[#AAD2FF] p-3 rounded-xl max-w-full w-[920px] m-auto px-8 py-4">
            <div class="text-center mb-10">
                <h1 class="text-4xl leading-tight font-bold">Form Test</h1>
                <h1 class="text-4xl leading-tight font-bold"><span class="text-[#008000]">Apps</span><span class="text-white">MD</span> <span class="text-[#0000ff]">& Gaya Belajar</span></h1>
                <h3 class="text-xl leading-tight mt-2 font-semibold italic ">Aplikasi Mengenal Diri</h3>
            </div>
            <div class="mb-3 bg-white p-5 text-center rounded-xl">
                @if(!empty($check_token->sudah_diisi))
                <h1 class="text-xl mb-4">Form Kuesioner telah diisi.</h1>
                <h3 class=""> Silahkan memeriksa whatsapp anda untuk mendapatkan sertifikat.</h3>
                @else
                <h1 class="text-xl mb-4">Form Kuesioner telah expired.</h1>
                <h3 class=""> Silahkan menghubungi admin untuk mendapatkan akses form kembali.</h3>
                @endif
            </div>
        </div>
    </div>
@include('layout.footer')