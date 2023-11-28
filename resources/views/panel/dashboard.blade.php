@extends('layout.navbar')
@section('navbarContent')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/datatable_tailwind.css">

    <h1 class="text-2xl font-semibold">Dashboard</h1>
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
                ajax    : {
                    url     : "{{ route('kuesioner.datatable') }}",
                    data    : function(data) {
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
        })
    </script>
@endsection