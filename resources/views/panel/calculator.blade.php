@extends('layout.navbar')
@section('navbarContent')

    <h1 class="text-2xl font-semibold mb-4">Kalkulator Tanggal Lahir</h1>

    <div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
        <label for="search" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Tanggal Lahir</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="date" id="tgl_lahir" class="block w-full p-4 pr-32 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" required>
            <button type="button" id="submit" class="text-white absolute end-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
        </div>
    </div>
    <div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
        <p class="text-sm mb-4">Hasil Angka : <span id="count"></span></p>
        <div class="overflow-y-auto w-full h-full" id="container-pdf"></div>
    </div>

    <script>
        $(() => {
            $("body").on("click","#submit",function(e){
                e.preventDefault();
                let tgl_lahir = $("#tgl_lahir").val();
                let count       = countTglLahir(tgl_lahir);
                $("#count").html(count);
                let url         = "{{ route('settings.hasil_tes.get',['kode_angka' => ':kode_angka']) }}".replace(':kode_angka',count);
                $("#container-pdf").html('');

                $.ajax({
                    url     : url,
                    success     : function(data){
                        let html    = "";
                        data.file_pdf.map(pdf => {
                            html    += `<img src="${pdf}" alt="" class="w-auto h-auto">`;
                        });

                        $("#container-pdf").html(html);
                    }
                })
            })

            function countTglLahir(tgl_lahir){
                let replace     = tgl_lahir.replace(/[^0-9]/g,'');
                let split       = replace.split('');
                let count       = 0;
                split.map(data => {
                    count   += parseInt(data);
                });

                if(count.toString().length > 1){
                    return countTglLahir(count.toString());
                }else{
                    return count;
                }
            }
        })
    </script>
@endsection