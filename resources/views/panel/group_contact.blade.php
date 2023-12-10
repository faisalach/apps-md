@extends('layout.navbar')
@section('navbarContent')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/assets/datatable_tailwind.css">

	<h1 class="text-2xl font-semibold mb-4">Group Contact</h1>
	<div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
		
		<!-- Modal toggle -->
		<button class="btn-add-group_contact mb-4 block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
			Tambah Group Contact
		</button>

		<div class="relative">
			<table id="dt_group_contact" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
				<thead class="text-xs text-gray-700 uppercase bg-green-300 dark:bg-gray-700 dark:text-gray-400">
					<tr>
						<th scope="col" class="px-6 py-3">
							Nama Group
						</th>
						<th scope="col" class="px-6 py-3">
							Tanggal Dibuat
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
	<div id="group-contact-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<!-- Modal content -->
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 id="group-contact-modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
						Tambah Group
					</h3>
					<button type="button" class="btn-close-modal-group_contact text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
				<form id="form_input" action="{{ route('group_contact.insert') }}" class="p-4 md:p-5" method="POST">
                    @csrf
                    <input type="hidden" name="id_group" id="id_group">
                    <div class="mb-4">
                        <label for="nama_group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Group</label>
                        <input type="text" name="nama_group" id="nama_group" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type text" required="">
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
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
            const groupContactModal     = new Modal(document.getElementById('group-contact-modal'), {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            });

			$("#dt_group_contact").DataTable({
				processing : true,
				serverSide : true,
				ajax    : {
					url     : "{{ route('group_contact.datatable') }}",
				},
                order : [[1,"DESC"]],
				columns: [
					{ 
						data: 'nama_group',
						name: 'nama_group',
						class : "px-6 py-4"
					},
					{ 
						data: 'date_created',
						name: 'created_at',
						class : "px-6 py-4"
					},
					{
						// data : 'id',
						class : "px-6 py-4",
						orderable : false,
						render : (e,display,data) => {
                            let id      = data.id;
                            let url_detail     = "{{ route('contact.detail',['id_group_contact' => ':id_group_contact']) }}".replace(":id_group_contact",id);
							return `
								<button id="button_dropdown_group_contact_${id}" data-dropdown-toggle="dropdown" class="btn-dropdown" type="button">
									<i class="fas fa-fw fa-bars"></i>
								</button>

								<div id="menu_dropdown_group_contact_${id}" class="menu-dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
									<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                        <li>
											<a href="${url_detail}" class="block px-4 py-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
												<i class="fas fa-fw fa-address-book"></i>
												List Contact
											</a>
										</li>
                                        <li>
											<a href="#" data-id="${id}" class="btn-edit-group_contact block px-4 py-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
												<i class="fas fa-fw fa-pen-alt"></i>
												Edit
											</a>
										</li>
										<li>
											<a href="#" data-id="${id}" class="btn-delete-group_contact block px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
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
			
            $("body").on("click",".btn-close-modal-group_contact",function(e) {
				groupContactModal.hide();
			});
			
            $("body").on("click",".btn-add-group_contact",function(e) {
                e.preventDefault();

                groupContactModal.show();
                $("#form_input")[0].reset();
                $("#group-contact-modal-title").html("Tambah Group");
                let action 	= "{{ route('group_contact.insert') }}";
                $("#form_input").attr("action",action);
            });

            $("body").on("click",".btn-edit-group_contact",function(e) {
                e.preventDefault();

				let id 	= $(this).data("id");
				let url 	= "{{ route('group_contact.get',['id' => ':id']) }}".replace(":id",id);

				let action 	= "{{ route('group_contact.update',['id' => ':id']) }}".replace(":id",id);
                $("#form_input").attr("action",action);

                $.ajax({
                    url 	: url,
                    type 	: "GET",
                    data 	: {
                        _token : $(`{{ csrf_field() }}`).val()
                    },
                    success 	: (response) => {
                        groupContactModal.show();
                        $("#group-contact-modal-title").html("Edit Group");
                        $("#id_group").val(response.id);
                        $("#nama_group").val(response.nama_group);
                    }
                })
			})

			$("body").on("click",".btn-delete-group_contact",function(e) {
                e.preventDefault();

				let id 	= $(this).data("id");
				let url 	= "{{ route('group_contact.delete',['id' => ':id']) }}".replace(":id",id);
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
                            beforeSend: loadingSweetalert,
							success 	: (response) => {
								let message 	= response?.message;
								Swal.fire({
									title: message,
									icon: "success"
								});
								$("#dt_group_contact").DataTable().ajax.reload();
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
                    beforeSend: loadingSweetalert,
					success : (response) => {
						form.find("[type=submit]").prop("disabled",false);
						form[0].reset();
						groupContactModal.hide();
						$("#dt_group_contact").DataTable().ajax.reload();

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
			});
            

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
            
			$("body").on("click",".btn-dropdown",function(e) {
				e.preventDefault();

				$targetEl   = $(this).closest('td').find(".menu-dropdown")[0];
				const dropdown = new Dropdown($targetEl, this,{
					placement: 'left'
				});
				if(dropdown.isVisible()){
					dropdown.hide();
				}else{
					dropdown.show();
				}
			})

		})
	</script>
@endsection