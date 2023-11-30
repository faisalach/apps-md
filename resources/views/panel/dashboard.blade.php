@extends('layout.navbar')
@section('navbarContent')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/datatable_tailwind.css">

    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <div id="accordion-collapse" data-accordion="collapse">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border rounded-xl border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
                <span>Filter</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
          <div class="p-5 border rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <div class="grid lg:grid-cols-5 md:grid-cols-4 grid-cols-2  gap-3">
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="no_peserta" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Peserta</label>
                    <input type="text" id="no_peserta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="tahun_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Lahir</label>
                    <input type="number" min="1990" max="{{ date("Y") }}" id="tahun_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="bulan_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan Lahir</label>
    
                    <select id="bulan_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        <option value="">-- Pilih --</option>
                        @for($i = 1;$i<=12;$i++)
                        <option value="{{ $i }}">{{ date("M",strtotime(date("Y-$i-01"))) }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                    <select id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        <option value="">-- Pilih --</option>
                        @for($i = 1;$i<=31;$i++)
                        <option value="{{ $i < 10 ? "0".$i : $i }}">{{ $i < 10 ? "0".$i : $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="number_tgl_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hasil Tes</label>
                    <select id="number_tgl_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        <option value="">-- Pilih --</option>
                        @for($i = 1;$i <= 9;$i++)
                        <option value="{{ $i }}">{{ CustomHelper::get_value_number_tgl_lahir($i) }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="golongan_darah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Golongan Darah</label>
                    <select id="golongan_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        <option value="">-- Pilih --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div>
                    <label for="agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                    <input type="text" id="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                    <select id="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        <option value="">-- Pilih --</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="no_wa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No WA</label>
                    <input type="text" id="no_wa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="min_persentase_visual" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min Visual (%)</label>
                    <input type="number" min="0" max="100" id="min_persentase_visual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="max_persentase_visual" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Visual (%)</label>
                    <input type="number" min="0" max="100" id="max_persentase_visual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="min_persentase_auditory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min Auditory (%)</label>
                    <input type="number" min="0" max="100" id="min_persentase_auditory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="max_persentase_auditory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Auditory (%)</label>
                    <input type="number" min="0" max="100" id="max_persentase_auditory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="min_persentase_kinestetik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min Kinestetik (%)</label>
                    <input type="number" min="0" max="100" id="min_persentase_kinestetik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
                <div>
                    <label for="max_persentase_kinestetik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kinestetik (Max %)</label>
                    <input type="number" min="0" max="100" id="max_persentase_kinestetik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                </div>
            </div>
            <div class="mt-3">
                <button type="button" id="refresh_dt_kuesioner" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Filter</button>
                <a href="#" id="export_data" target="_blank" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Export</a>
            </div>
          </div>
        </div>
    </div>

    <div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
        <div class="relative overflow-x-auto">
            <table id="dt_kuesioner" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-green-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Lengkap
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No Peserta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tempat Lahir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Lahir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hasil Tes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Golongan Darah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Agama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No WA
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Persentase Visual
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Persentase Auditory
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Persentase Kinestetik
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="/assets/datatable_tailwind.js"></script>
    <script>
        $(() => {
            $("#dt_kuesioner").DataTable({
                processing : true,
                serverSide : true,
                drawCallback: () => {
                    let params = $("#dt_kuesioner").DataTable().ajax.params();
                    let url_export  = $("#export_data").attr("href","{{ route('kuesioner.export_csv') }}?" + $.param(params));
                },
                ajax    : {
                    url     : "{{ route('kuesioner.datatable') }}",
                    data    : function(data) {
                        data.filter     = {
                            nama_lengkap : $("#nama_lengkap").val(),
                            no_peserta : $("#no_peserta").val(),
                            tempat_lahir : $("#tempat_lahir").val(),
                            tahun_lahir : $("#tahun_lahir").val(),
                            bulan_lahir : $("#bulan_lahir").val(),
                            tanggal_lahir : $("#tanggal_lahir").val(),
                            number_tgl_lahir : $("#number_tgl_lahir").val(),
                            golongan_darah : $("#golongan_darah").val(),
                            agama : $("#agama").val(),
                            jenis_kelamin : $("#jenis_kelamin").val(),
                            alamat : $("#alamat").val(),
                            email : $("#email").val(),
                            no_wa : $("#no_wa").val(),
                            min_persentase : {
                                persentase_visual : $("#min_persentase_visual").val(),
                                persentase_auditory : $("#min_persentase_auditory").val(),
                                persentase_kinestetik : $("#min_persentase_kinestetik").val(),
                            },
                            max_persentase : {
                                persentase_visual : $("#max_persentase_visual").val(),
                                persentase_auditory : $("#max_persentase_auditory").val(),
                                persentase_kinestetik : $("#max_persentase_kinestetik").val()
                            }
                        }
                        return data
                    }
                },
                columns: [
                    { 
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'no_peserta',
                        name: 'no_peserta',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'tempat_lahir',
                        name: 'tempat_lahir',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'hasil_tes',
                        name: 'number_tgl_lahir',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'golongan_darah',
                        name: 'golongan_darah',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'agama',
                        name: 'agama',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'alamat',
                        name: 'alamat',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'email',
                        name: 'email',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'no_wa',
                        name: 'no_wa',
                        class : "px-6 py-4"
                    },
                    { 
                        data: 'persentase_visual',
                        name: 'persentase_visual',
                        class : "px-6 py-4",
                        render : (data) => {
                            return data + "%";
                        }
                    },
                    { 
                        data: 'persentase_auditory',
                        name: 'persentase_auditory',
                        class : "px-6 py-4",
                        render : (data) => {
                            return data + "%";
                        }
                    },
                    { 
                        data: 'persentase_kinestetik',
                        name: 'persentase_kinestetik',
                        class : "px-6 py-4",
                        render : (data) => {
                            return data + "%";
                        }
                    },
                ]
                
            });

            $("body").on("click","#refresh_dt_kuesioner",(e) => {
                e.preventDefault();
                
                $("#dt_kuesioner").DataTable().ajax.reload();
            })
        })
    </script>
@endsection