@extends('layout.navbar')
@section('navbarContent')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/assets/datatable_tailwind.css">

	<h1 class="text-2xl font-semibold mb-4">Contact</h1>
	<div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
		
		<!-- Modal toggle -->
		<button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class=" mb-4 block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
			Tambah Contact
		</button>

		<div class="relative">
			<table id="dt_contact" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
				<thead class="text-xs text-gray-700 uppercase bg-green-300 dark:bg-gray-700 dark:text-gray-400">
					<tr>
						<th scope="col" class="px-6 py-3">
							Nomor Contact
						</th>
						<th scope="col" class="px-6 py-3">
							Link
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
	<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<!-- Modal content -->
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
						Tambah Contact
					</h3>
					<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
				

				<div class="border-b border-gray-200 dark:border-gray-700">
					<ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
						<li class="me-2" role="presentation">
							<button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Form</button>
						</li>
						<li class="me-2" role="presentation">
							<button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">CSV</button>
						</li>
					</ul>
				</div>
				<div id="default-tab-content">
					<div class="hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<form id="form_input" action="{{ route('contact.insert') }}" class="p-4 md:p-5" method="POST">
							<div class="mb-4">
								<label for="nomor_contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Contact</label>
								<input type="text" name="nomor_contact" id="nomor_contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type number" required="">
							</div>
							<button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
								<svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
								Submit
							</button>
						</form>
					</div>
					<div class="hidden" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
						<form id="form_csv" action="{{ route('contact.insert_csv') }}" class="p-4 md:p-5" method="POST">
							<div class="mb-4">
								<label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File CSV</label>
								<input accept=".csv" id="file" name="file" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
							</div>
							<button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
								<svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
								Submit
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> 


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script src="/assets/datatable_tailwind.js"></script>
	<script>
		$(() => {
			$("#dt_contact").DataTable({
				processing : true,
				serverSide : true,
				ajax    : {
					url     : "{{ route('contact.datatable') }}",
				},
				columns: [
					{ 
						data: 'nomor_contact',
						name: 'nomor_contact',
						class : "px-6 py-4"
					},
					{ 
						data: 'url',
						name: 'url',
						orderable : false,
						class : "px-6 py-4"
					},
					{
						data : 'id',
						class : "px-6 py-4",
						orderable : false,
						render : (id) => {
							return `
								<button id="button_dropdown_contact_${id}" data-dropdown-toggle="dropdown" class="btn-dropdown" type="button">
									<i class="fas fa-fw fa-bars"></i>
								</button>

								<div id="menu_dropdown_contact_${id}" class="menu-dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
									<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
										<li>
											<a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
												<i class="fas fa-fw fa-paper-plane"></i>
												Send WA</a>
										</li>
										<li>
											<a href="#" class="block px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
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

			$("body").on("click","#refresh_dt_contact",(e) => {
				e.preventDefault();
				
				$("#dt_contact").DataTable().ajax.reload();
			})

			$("body").on("click",".btn-dropdown",(e) => {
				e.preventDefault();

				$targetEl   = $(e.target).closest('td').find(".menu-dropdown")[0];
				const dropdown = new Dropdown($targetEl, e.target,{
					placement: 'left'
				});
				if(dropdown.isVisible()){
					dropdown.hide();
				}else{
					dropdown.show();
				}
				
			})

			$("body").on("submit","#form_input",(e) => {
				e.preventDefault();

				
				let form 		= $(e.target);
				let nomor_contact 	= $("#nomor_contact").val();
				let url 		= form.attr("action");
				let method 		= form.attr("method");

				form.find("[type=submit]").prop("disabled",true);
				if(form.find(".alert").length > 0){
					form.find(".alert")[0].outerHTML = '';
				}

				$.ajax({
					type : method,
					url : url,
					data : {
						_token	: $(`{{ csrf_field() }}`).val(),
						nomor_contact : nomor_contact
					},
					success : (response) => {
						form.find("[type=submit]").prop("disabled",false);
						$("#crud-modal").find("[data-modal-toggle]").click();
						$("#dt_contact").DataTable().ajax.reload();

						form[0].reset();
						
						Swal.fire({
							title: response?.message,
							icon: "success"
						});
					},
					error : (response) => {
						form.find("[type=submit]").prop("disabled",false);

						let message 	= response?.responseJSON?.message;

						form.prepend(`
							<div class="alert p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
								${message}
							</div>
						`);
					}
				});
			})

			$("body").on("submit","#form_csv",(e) => {
				e.preventDefault();
				
				let form 		= $(e.target);
				let file 		= $("#file").prop("files")[0];
				let url 		= form.attr("action");
				let method 		= form.attr("method");

				let formData 	= new FormData();
				formData.append("file", file);
				formData.append("_token", $(`{{ csrf_field() }}`).val());


				form.find("[type=submit]").prop("disabled",true);
				if(form.find(".alert").length > 0){
					form.find(".alert")[0].outerHTML = '';
				}

				$.ajax({
					type : method,
					url : url,
					processData: false,
					contentType: false,
					data : formData,
					success : (response) => {
						form.find("[type=submit]").prop("disabled",false);
						$("#crud-modal").find("[data-modal-toggle]").click();
						$("#dt_contact").DataTable().ajax.reload();

						form[0].reset();
						
						Swal.fire({
							title: response?.message,
							icon: "success"
						});
					},
					error : (response) => {
						form.find("[type=submit]").prop("disabled",false);

						let message 	= response?.responseJSON?.message;

						form.prepend(`
							<div class="alert p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
								${message}
							</div>
						`);
					}
				});
			})
		})
	</script>
@endsection