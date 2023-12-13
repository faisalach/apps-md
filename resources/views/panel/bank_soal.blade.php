@extends('layout.navbar')
@section('navbarContent')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/assets/datatable_tailwind.css">

	<h1 class="text-2xl font-semibold mb-4">Bank Soal</h1>
	<div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
		
		<!-- Modal toggle -->
		<button class="btn-add-bank-soal mb-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
			Tambah Soal
		</button>

		<div class="relative overflow-x-auto">
			<table id="dt_bank_soal" class="w-full text-sm text-left rtl:text-right text-gray-500">
				<thead class="text-xs text-white uppercase bg-blue-500">
					<tr>
						<th scope="col" class="px-6 py-3">
							Nomor Urut
						</th>
						<th scope="col" class="px-6 py-3">
							Pertanyaan
						</th>
						<th scope="col" class="px-6 py-3">
							#
						</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Main modal -->
	<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<!-- Modal content -->
			<div class="relative bg-white rounded-lg shadow">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
					<h3 class="title-modal text-lg font-semibold text-gray-900">
						Tambah Soal
					</h3>
					<button type="button" class="btn-close-default-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
                
                <form id="form_input" action="{{ route('bank_soal.insert') }}" class="p-4 md:p-5" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="no_urut" class="block mb-2 text-sm font-medium text-gray-900">Nomor Urut</label>
                        <input name="no_urut" type="number" id="no_urut" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type number">
                    </div>
                    <div class="mb-4">
                        <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea name="pertanyaan" rows="5" id="pertanyaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type text"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="visual" class="block mb-2 text-sm font-medium text-gray-900">Jawaban Visual</label>
                        <input name="jawaban[visual]" type="text" id="visual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type text">
                    </div>
                    <div class="mb-4">
                        <label for="auditory" class="block mb-2 text-sm font-medium text-gray-900">Jawaban Auditory</label>
                        <input name="jawaban[auditory]" type="text" id="auditory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type text">
                    </div>
                    <div class="mb-4">
                        <label for="kinestetik" class="block mb-2 text-sm font-medium text-gray-900">Jawaban Kinestetik</label>
                        <input name="jawaban[kinestetik]" type="text" id="kinestetik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type text">
                    </div>
                    <button type="submit" class="disabled:bg-blue-300 disabled:cursor-wait text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Submit
                    </button>
                </form>

			</div>
		</div>
	</div> 


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script src="/assets/datatable_tailwind.js"></script>
	<script>
		$(() => {

            const defaultModal = new Modal(document.getElementById('default-modal'), {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: true,
            }, {
                id: 'default-modal',
                override: true
            });

			$("#dt_bank_soal").DataTable({
				processing : true,
				serverSide : true,
				ajax    : {
					url     : "{{ route('bank_soal.datatable') }}",
				},
				columns: [
					{ 
						data: 'no_urut',
						name: 'no_urut',
						class : "px-6 py-4"
					},
					{ 
						data: 'pertanyaan',
						name: 'pertanyaan',
						class : "px-6 py-4"
					},
					{
						data : 'id',
						class : "px-6 py-4",
						orderable : false,
						render : (id) => {
							return `
								<button id="button_dropdown_bank_soal_${id}" data-dropdown-toggle="dropdown" class="btn-dropdown" type="button">
									<i class="fas fa-fw fa-bars"></i>
								</button>

								<div id="menu_dropdown_bank_soal_${id}" class="menu-dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
									<ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                        <li>
											<a href="#" data-id="${id}" class="btn-edit-bank-soal block px-4 py-2 text-gray-500 hover:bg-gray-100">
												<i class="fas fa-fw fa-pen-alt"></i>
												Edit
											</a>
										</li>
										<li>
											<a href="#" data-id="${id}" class="btn-delete-bank-soal block px-4 py-2 text-red-500 hover:bg-gray-100">
												<i class="fas fa-fw fa-trash-alt"></i>
												Hapus
											</a>
										</li>
									</ul>
								</div>
								`;
						}
					},
				]
				
			});

			$("body").on("click",".btn-dropdown",function(e) {
				e.preventDefault();

				let $targetEl   = $(this).closest('td').find(".menu-dropdown")[0];
				const dropdown = new Dropdown($targetEl, this,{
					placement: 'left'
				});
				if(dropdown.isVisible()){
					dropdown.hide();
				}else{
					dropdown.show();
				}
				
			})

			$("body").on("submit","#form_input",function(e) {
				e.preventDefault();

				let form 		= $(this);
				let url 		= form.attr("action");
				let method 		= form.attr("method");

				form.find("[type=submit]").prop("disabled",true);
				if(form.find(".alert").length > 0){
					form.find(".alert")[0].outerHTML = '';
				}

				$.ajax({
					type : method,
					url : url,
					data : $(this).serialize(),
					success : (response) => {
						form.find("[type=submit]").prop("disabled",false);
						form[0].reset();
						
						Swal.fire({
                            title: response?.message,
							icon: "success"
						});

                        defaultModal.hide();
                        $("#dt_bank_soal").DataTable().ajax.reload();
					},
					error : (response) => {
						form.find("[type=submit]").prop("disabled",false);

						let message 	= response?.responseJSON?.message;
						form.prepend(`
							<div class="alert p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
								${message}
							</div>
						`);
					}
				});
			})
            
            $("body").on("click",".btn-add-bank-soal",function(e) {
                e.preventDefault();

                defaultModal.show();
                $("#form_input")[0].reset();
                $("#default-modal").find(".title-modal").html("Tambah Soal");

                let action 	= "{{ route('bank_soal.insert') }}";
                $("#form_input").prop("action",action);
            })

            $("body").on("click",".btn-close-default-modal",function(e) {
                e.preventDefault();
                defaultModal.hide();
            })

            $("body").on("click",".btn-edit-bank-soal",function(e) {
                e.preventDefault();
                $("#form_input")[0].reset();
                $("#default-modal").find(".title-modal").html("Edit Soal");
                
				let id 	= $(this).data("id");
				let url 	= "{{ route('bank_soal.get',['id' => ':id']) }}".replace(":id",id);
				let action 	= "{{ route('bank_soal.update',['id' => ':id']) }}".replace(":id",id);

                $("#form_input").prop("action",action);
                $.ajax({
                    url 	: url,
                    type 	: "GET",
                    success 	: (response) => {
                        defaultModal.show();
                        $("#no_urut").val(response.no_urut);
                        $("#pertanyaan").val(response.pertanyaan);
                        response.bank_soal_jawaban.map(jwb => {
                            $("#"+jwb.type).val(jwb.jawaban);
                        })
                    }
                })
			})

			$("body").on("click",".btn-delete-bank-soal",function(e) {
                e.preventDefault();

				let id 	= $(this).data("id");
				let url 	= "{{ route('bank_soal.delete',['id' => ':id']) }}".replace(":id",id);
				Swal.fire({
					title: "Hapus data ini?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url 	: url,
							type 	: "POST",
							data 	: {
								_token : $(`{{ csrf_field() }}`).val()
							},
							success 	: (response) => {
								let message 	= response?.message;
								Swal.fire({
									title: message,
									icon: "success"
								});
								$("#dt_bank_soal").DataTable().ajax.reload();
							},
							error 	: (response) => {
								let message 	= response?.responseJSON?.message;
								Swal.fire({
									title: message,
									icon: "error"
								});
							}
						})
					}
				});
			})

		})
	</script>
@endsection