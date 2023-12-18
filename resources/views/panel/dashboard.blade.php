@extends('layout.navbar')
@section('navbarContent')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/datatable_tailwind.css">

    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
    <div id="accordion-collapse" data-accordion="collapse">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border rounded-xl border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
                <span>Filter</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
          <div class="p-5 border rounded-xl border-gray-200">
            <div class="grid lg:grid-cols-5 md:grid-cols-4 grid-cols-2  gap-3">
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="no_peserta" class="block mb-2 text-sm font-medium text-gray-900">No Peserta</label>
                    <input type="text" id="no_peserta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="tahun_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tahun Lahir</label>
                    <input type="number" min="1990" max="{{ date("Y") }}" id="tahun_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="bulan_lahir" class="block mb-2 text-sm font-medium text-gray-900">Bulan Lahir</label>
    
                    <select id="bulan_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                        <option value="">-- Pilih --</option>
                        @for($i = 1;$i<=12;$i++)
                        <option value="{{ $i }}">{{ date("M",strtotime(date("Y-$i-01"))) }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <select id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                        <option value="">-- Pilih --</option>
                        @for($i = 1;$i<=31;$i++)
                        <option value="{{ $i < 10 ? "0".$i : $i }}">{{ $i < 10 ? "0".$i : $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="number_tgl_lahir" class="block mb-2 text-sm font-medium text-gray-900">Hasil Tes</label>
                    <select id="number_tgl_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                        <option value="">-- Pilih --</option>
                        @for($i = 1;$i <= 9;$i++)
                        <option value="{{ $i }}">{{ CustomHelper::get_value_number_tgl_lahir($i) }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="golongan_darah" class="block mb-2 text-sm font-medium text-gray-900">Golongan Darah</label>
                    <select id="golongan_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                        <option value="">-- Pilih --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div>
                    <label for="agama" class="block mb-2 text-sm font-medium text-gray-900">Agama</label>
                    <input type="text" id="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select id="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                        <option value="">-- Pilih --</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <input type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="no_wa" class="block mb-2 text-sm font-medium text-gray-900">No WA</label>
                    <input type="text" id="no_wa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="min_persentase_visual" class="block mb-2 text-sm font-medium text-gray-900">Min Visual (%)</label>
                    <input type="number" min="0" max="100" id="min_persentase_visual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="max_persentase_visual" class="block mb-2 text-sm font-medium text-gray-900">Max Visual (%)</label>
                    <input type="number" min="0" max="100" id="max_persentase_visual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="min_persentase_auditory" class="block mb-2 text-sm font-medium text-gray-900">Min Auditory (%)</label>
                    <input type="number" min="0" max="100" id="min_persentase_auditory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="max_persentase_auditory" class="block mb-2 text-sm font-medium text-gray-900">Max Auditory (%)</label>
                    <input type="number" min="0" max="100" id="max_persentase_auditory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="min_persentase_kinestetik" class="block mb-2 text-sm font-medium text-gray-900">Min Kinestetik (%)</label>
                    <input type="number" min="0" max="100" id="min_persentase_kinestetik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
                <div>
                    <label for="max_persentase_kinestetik" class="block mb-2 text-sm font-medium text-gray-900">Kinestetik (Max %)</label>
                    <input type="number" min="0" max="100" id="max_persentase_kinestetik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
                </div>
            </div>
            <div class="mt-3">
                <button type="button" id="refresh_dt_kuesioner" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Filter</button>
                <a href="#" id="export_data" target="_blank" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Export CSV</a>
            </div>
          </div>
        </div>
    </div>

    <div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
        <div class="mb-3">
            <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Pengisian</label>
            <input type="date" id="created_at" value="{{ date("Y-m-d") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="...">
        </div>
        <div class="flex flex-row flex-wrap">
			<button id="button-delete-kuesioner-selected" class="mr-2 hidden disabled:bg-red-500 disabled:cursor-wait mb-2 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
				Hapus Kuesioner yang dipilih
			</button>
			<button id="button-delete-kuesioner-all" class="mr-2 disabled:bg-red-500 disabled:cursor-wait mb-2 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
				Hapus Semua Kuesioner
			</button>
		</div>

        <div class="relative overflow-x-auto">
            <table id="dt_kuesioner" class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-white uppercase bg-blue-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">
							<input type="checkbox" id="checkbox-kuesioner-all" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
						</th>
                        <th scope="col" class="px-6 py-3">
                            Waktu Pengisian Form
                        </th>
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
            let totalData 			= 0;
            $("#dt_kuesioner").DataTable({
                processing : true,
                serverSide : true,
                drawCallback: (data) => {
                    let params = $("#dt_kuesioner").DataTable().ajax.params();
                    let url_export  = $("#export_data").attr("href","{{ route('kuesioner.export_csv') }}?" + $.param(params));
                    $("#checkbox-kuesioner-all").prop("checked",false);
                    totalData = data.json.recordsTotal;
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
                            created_at : $("#created_at").val(),
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
						data: 'id',
						orderable : false,
						class : "px-6 py-4",
						render : (id) => {
							return `
							<input type="checkbox" value="${id}" class="checkbox-kuesioner w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
							`;
						}
					},
                    { 
                        data: 'created_at',
                        name: 'created_at',
                        class : "px-6 py-4",
                        render : function(created_at){
                            let d    = new Date(created_at);
                            let year    = d.getFullYear();
                            let month     = (d.getMonth() + 1) > 9 ? (d.getMonth() + 1) : "0"+(d.getMonth() + 1);
                            let date     = d.getDate() > 9 ? d.getDate() : "0"+d.getDate();
                            let hour     = d.getHours() > 9 ? d.getHours() : "0"+d.getHours();
                            let minute     = d.getMinutes() > 9 ? d.getMinutes() : "0"+d.getMinutes();

                            return `${year}-${month}-${date} ${hour}:${minute}`;
                        }
                    },
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
                        name: 'hasil_tes',
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
                ],
                order : [[1,"DESC"]]
                
            });

            $("body").on("click","#refresh_dt_kuesioner",(e) => {
                e.preventDefault();
                
                $("#dt_kuesioner").DataTable().ajax.reload();
            })

            $("body").on("change","#created_at",(e) => {
                e.preventDefault();
                
                $("#dt_kuesioner").DataTable().ajax.reload();
            })

            $("body").on("click","#checkbox-kuesioner-all",function(e){
				if($(this).is(":checked")){
					$(".checkbox-kuesioner").prop("checked",true);
				}else{
					$(".checkbox-kuesioner").prop("checked",false);
				}
				showHideBtnKuesionerSelected();
			});
			$("body").on("click",".checkbox-kuesioner",function(e){
				showHideBtnKuesionerSelected();
				if($(".checkbox-kuesioner:checked").length >= $(".checkbox-kuesioner").length){
					$("#checkbox-kuesioner-all").prop("checked",true);
				}else{
					$("#checkbox-kuesioner-all").prop("checked",false);
				}
			});
			
			function showHideBtnKuesionerSelected(){
				$("#button-delete-kuesioner-selected").addClass("hidden");
				if($(".checkbox-kuesioner:checked").length > 0){
					$("#button-delete-kuesioner-selected").removeClass("hidden");
				}
			}

            $("body").on("click", "#button-delete-kuesioner-selected",function(e){
				e.preventDefault();

				let id_arr 	= [];
				$.each($(".checkbox-kuesioner:checked"),function(k,el){
					id_arr.push($(el).val());
				})

				if(id_arr.length < 1){
					Swal.fire("Pilih kuesioner terlebih dulu","","error");
					return false;
				}
				Swal.fire({
					title: `Hapus kuesioner terpilih?`,
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url : "{{ route('kuesioner.delete_bulk') }}",
							type 	: "POST",
							data 	: {
								_token 	: $(`{{ csrf_field() }}`).val(),
								id : id_arr
							},
							beforeSend:loadingSweetalert,
							success : function(response) {
								$(".checkbox-kuesioner").prop("checked",false);
								showHideBtnKuesionerSelected();
								$("#dt_kuesioner").DataTable().ajax.reload();
								Swal.fire(response?.message,"","success");
							},
							error : function(response) {
								Swal.fire(response?.responseJSON?.message,"","error");
							}
						})
					}
				});
			})

			$("body").on("click", "#button-delete-kuesioner-all",function(e){
				e.preventDefault();

                let date    = $("#created_at").val()

				Swal.fire({
					title: `Hapus seluruh kuesioner pada tanggal ${date} (${totalData} kuesioner)?`,
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url : "{{ route('kuesioner.delete_bulk') }}",
							type 	: "POST",
							data 	: {
								_token 	: $(`{{ csrf_field() }}`).val(),
                                date : date
							},
							beforeSend:loadingSweetalert,
							success : function(response) {
								$(".checkbox-kuesioner").prop("checked",false);
								showHideBtnKuesionerSelected();
								$("#dt_kuesioner").DataTable().ajax.reload();
								Swal.fire(response?.message,"","success");
							},
							error : function(response) {
								Swal.fire(response?.responseJSON?.message,"","error");
							}
						})
					}
				});

			})

            function loadingSweetalert() {
                Swal.fire({
                    html: '<h5>Loading...</h5>',
                    showConfirmButton: false,
                    icon : "warning",
                    onRender: function() {
                        let sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
                        // there will only ever be one sweet alert open.
                        $('.swal2-content').prepend(sweet_loader);
                    }
                });
            }
        })
    </script>
@endsection