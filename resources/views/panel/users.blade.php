@extends('layout.navbar')
@section('navbarContent')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/assets/datatable_tailwind.css">

	<h1 class="text-2xl font-semibold mb-4">Users</h1>
	<div class="p-5 mt-4 bg-gray-50 rounded-lg border shadow">
		
		<!-- Modal toggle -->
		<button class="btn-add-users mb-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
			Tambah User
		</button>

		<div class="relative">
			<table id="dt_users" class="w-full text-sm text-left rtl:text-right text-gray-500">
				<thead class="text-xs text-white uppercase bg-blue-500">
					<tr>
						<th scope="col" class="px-6 py-3">
							Username
						</th>
						<th scope="col" class="px-6 py-3">
							Role
						</th>
						<th scope="col" class="px-6 py-3">
							Cabang
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
						Tambah User
					</h3>
					<button type="button" class="btn-close-default-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
                
                <form id="form_input" action="{{ route('users.insert') }}" class="p-4 md:p-5" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username"  placeholder="Type text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password"  placeholder="Type text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="superadmin">Superadmin</option>
                            <option value="admin_cabang">Cabang</option>
                            <option value="agen">Agen</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="id_cabang" class="block mb-2 text-sm font-medium text-gray-900">Cabang</label>
                        <select name="id_cabang" id="id_cabang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Cabang</option>
                            @foreach($cabang as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_cabang }}</option>
                            @endforeach
                        </select>
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
                onShow : () => {
                    $("#id_cabang").parent().hide();
                }
            }, {
                id: 'default-modal',
                override: true
            });

			$("#dt_users").DataTable({
				processing : true,
				serverSide : true,
				ajax    : {
					url     : "{{ route('users.datatable') }}",
				},
				columns: [
					{ 
						data: 'username',
						name: 'username',
						class : "px-6 py-4"
					},
					{ 
						data: 'nama_role',
						name: 'role',
						class : "px-6 py-4"
					},
					{ 
						data: 'cabang.nama_cabang',
						name: 'cabang.nama_cabang',
						class : "px-6 py-4"
					},
					{
						data : 'id',
						class : "px-6 py-4",
						orderable : false,
						render : (id) => {
							return `
								<button id="button_dropdown_users_${id}" data-dropdown-toggle="dropdown" class="btn-dropdown" type="button">
									<i class="fas fa-fw fa-bars"></i>
								</button>

								<div id="menu_dropdown_users_${id}" class="menu-dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
									<ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                        <li>
											<a href="#" data-id="${id}" class="btn-edit-users block px-4 py-2 text-gray-500 hover:bg-gray-100">
												<i class="fas fa-fw fa-pen-alt"></i>
												Edit
											</a>
										</li>
										<li>
											<a href="#" data-id="${id}" class="btn-delete-users block px-4 py-2 text-red-500 hover:bg-gray-100">
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

			$("body").on("click","#refresh_dt_users",function(e) {
				e.preventDefault();
				
				$("#dt_users").DataTable().ajax.reload();
			})

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
			$("body").on("change","#role",function(e) {
                if($(this).val() === "superadmin"){
                    $("#id_cabang").parent().hide();
                }else{
                    $("#id_cabang").parent().show();
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
                        $("#dt_users").DataTable().ajax.reload();
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
            
            $("body").on("click",".btn-add-users",function(e) {
                e.preventDefault();

                defaultModal.show();
                $("#form_input")[0].reset();
                $("#default-modal").find(".title-modal").html("Tambah User");

                let action 	= "{{ route('users.insert') }}";
                $("#form_input").prop("action",action);
            })

            $("body").on("click",".btn-close-default-modal",function(e) {
                e.preventDefault();
                defaultModal.hide();
            })

            $("body").on("click",".btn-edit-users",function(e) {
                e.preventDefault();

                $("#form_input")[0].reset();
                $("#default-modal").find(".title-modal").html("Edit User");
                
				let id 	= $(this).data("id");
				let url 	= "{{ route('users.get',['id' => ':id']) }}".replace(":id",id);
				let action 	= "{{ route('users.update',['id' => ':id']) }}".replace(":id",id);

                $("#form_input").prop("action",action);
                $.ajax({
                    url 	: url,
                    type 	: "GET",
                    success 	: (response) => {
                        defaultModal.show();
                        $("#username").val(response.username);
                        console.log(response.role);
                        $("#role").val(response.role).change();
                        $("#id_cabang").val(response.id_cabang).select();
                    }
                })
			})

			$("body").on("click",".btn-delete-users",function(e) {
                e.preventDefault();

				let id 	= $(this).data("id");
				let url 	= "{{ route('users.delete',['id' => ':id']) }}".replace(":id",id);
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
								$("#dt_users").DataTable().ajax.reload();
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