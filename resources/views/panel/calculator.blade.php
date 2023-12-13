@extends('layout.navbar')
@section('navbarContent')

    <h1 class="text-2xl font-semibold mb-4">Kalkulator Tanggal Lahir</h1>

    <div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
        <label for="search" class="mb-2 text-sm font-medium text-gray-900">Masukkan Tanggal Lahir</label>
        <input type="date" id="tgl_lahir" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" required>
        <button type="button" id="submit" class="text-white mt-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Submit</button>
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