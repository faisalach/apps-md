@extends('layout.navbar')
@section('navbarContent')
    <div class="p-5 bg-gray-50 rounded-lg border shadow">
        <form action="" method="POST">
            @csrf
            <h3 class="text-lg font-bold">Ganti Password</h3>
            @if (Session::has('message'))
            <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                {{ Session::get("message") }}
            </div>
            @endif
            <div class="grid grid-cols-2 mt-3 gap-2">
                <div class="bg-white rounded-lg py-3 px-5 mb-3 border shadow">
                    <label for="password" class="text-xs uppercase font-semibold">Password Baru*</label>
                    <input type="password" required id="password" name="password" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Password Baru">
                    @error("password")
                    <p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('password') }}</p>
                    @enderror
                </div>
                <div class="bg-white rounded-lg py-3 px-5 mb-3 border shadow">
                    <label for="conf_password" class="text-xs uppercase font-semibold">Konfirmasi Password*</label>
                    <input type="password" required id="conf_password" name="conf_password" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Konfirmasi Password">
                    @error("conf_password")
                    <p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('conf_password') }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" name="change_password" value="1" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>
        </form>
    </div>
@endsection