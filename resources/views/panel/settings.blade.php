@extends('layout.navbar')
@section('navbarContent')
	<div class="p-5 bg-gray-50 rounded-lg border shadow">
		<form action="" method="POST">
			@csrf
			<h3 class="text-lg font-bold">Ganti Akun</h3>
			@if (Session::has('message'))
			<div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
				{{ Session::get("message") }}
			</div>
			@endif
			<div class="grid grid-cols-2 mt-3 gap-2">
				<div class="col-span-2 bg-white rounded-lg py-3 px-5 mb-3 border shadow">
					<label for="username" class="text-xs uppercase font-semibold">Username*</label>
					<input type="text" value="{{ Auth::user()->username }}" required id="username" name="username" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Username">
					@error("username")
					<p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('username') }}</p>
					@enderror
				</div>
				<div class="bg-white rounded-lg py-3 px-5 mb-3 border shadow">
					<label for="password" class="text-xs uppercase font-semibold">Password Baru*</label>
					<input type="password" id="password" name="password" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Password Baru">
					@error("password")
					<p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('password') }}</p>
					@enderror
				</div>
				<div class="bg-white rounded-lg py-3 px-5 mb-3 border shadow">
					<label for="conf_password" class="text-xs uppercase font-semibold">Konfirmasi Password*</label>
					<input type="password" id="conf_password" name="conf_password" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Konfirmasi Password">
					@error("conf_password")
					<p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('conf_password') }}</p>
					@enderror
				</div>
			</div>
			<button type="submit" name="change_password" value="1" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>
		</form>
	</div>
	<div class="p-5 mt-5 bg-gray-50 rounded-lg border shadow">
		<h3 class="text-lg font-bold">Hasil Tes</h3>
		@if (Session::has('message_hasil_tes'))
		<div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
			{{ Session::get("message_hasil_tes") }}
		</div>
		@endif
		
		<div class="relative my-5">
			<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
				<thead class="text-xs text-gray-700 uppercase bg-green-200 dark:bg-green-700 dark:text-gray-400">
					<tr>
						<th scope="col" class="px-6 py-3">
							Kode Angka
						</th>
						<th scope="col" class="px-6 py-3">
							Title
						</th>
						<th scope="col" class="px-6 py-3">
							File PDF
						</th>
						<th scope="col" class="px-6 py-3">
							#
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hasil_tes as $row)
					<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
						<td class="px-6 py-4">
							{{ $row->kode_angka }}
						</td>
						<td class="px-6 py-4">
							{{ $row->title }}
						</td>
						<td class="px-6 py-4">
							@php
								$get_file_pdf = CustomHelper::get_pdf_hasil_tes($row->kode_angka);
							@endphp
							
							@if (!empty($get_file_pdf))
								<div class="overflow-y-auto w-64 h-64">
									@foreach($get_file_pdf as $file)
										<img src="{{ $file }}" alt="" class="w-auto h-auto">
									@endforeach
								</div>
							@endif
						</td>
						<td class="px-3 py-2">
							<button type="button" data-id="{{ $row->kode_angka }}" class="btn-edit-hasil-tes focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
								<i class="fas fa-fw fa-pen"></i>
								Edit
							</button>
						</td>
					</tr>
					@endforeach
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
						Edit Hasil Tes
					</h3>
					<button type="button" class="btn-close-crud-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
				<div id="message-container" class="hidden p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert"></div>
				<form id="form_edit_hasil_tes" enctype="multipart/form-data" class="p-4 md:p-5" method="POST">
					@csrf
					<div class="mb-4">
						<label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
						<input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Title">
					</div>
					<div class="mb-4">
						<label for="file_zip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File ZIP / JPG</label>
						<input type="file" accept=".zip,.jpg" name="file_zip" id="file_zip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
						<small class="text-red-500 block">* Upload untuk mengganti file sebelumnya</small>
						<small class="text-red-500 block">* Gunakan converter PDF to JPG di <a class="text-blue-500" href="https://www.ilovepdf.com/pdf_to_jpg" target="_blank">https://www.ilovepdf.com/pdf_to_jpg</a></small>
					</div>
					<button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
						<svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
						Submit
					</button>
				</form>
			</div>
		</div>
	</div> 

	<script>
		$(() => {
			const $targetElCrudModal = document.getElementById('crud-modal');
			const crudModal = new Modal($targetElCrudModal);

			$("body").on("click",".btn-edit-hasil-tes",function(e) {
				e.preventDefault();
				
				let id 		= $(this).data("id");
				let url 	= `{{ route('settings.hasil_tes.update',['kode_angka' => ":kode_angka"]) }}`;
				url 		= url.replace(":kode_angka",id);
				$("#form_edit_hasil_tes").attr("action",url);

				$.ajax({
					url 	: `{{ route('settings.hasil_tes.get',['kode_angka' => ":kode_angka"]) }}`.replace(":kode_angka",id),
					success : (response) => {
						crudModal.show();
						$("#title").val(response.title);
					}
				});
			})

			$("body").on("click",".btn-close-crud-modal",function(e) {
				e.preventDefault();
				crudModal.hide();
			})
		})
	</script>
@endsection