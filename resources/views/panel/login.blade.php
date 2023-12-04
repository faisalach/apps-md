@include('layout.header')
    <div style="background-image: url('/assets/bg1.jpg')" class="min-h-screen bg-repeat-y bg-cover p-4">
        <form action="{{ route('authenticated') }}" method="POST">
            @csrf
            <div class="w-md bg-[#AAD2FF] p-3 rounded-xl max-w-full w-[920px] m-auto px-8 py-4">
                <div class="text-center mb-10">
                    <h1 class="text-4xl leading-tight font-bold">Form Test</h1>
                    <h1 class="text-4xl leading-tight font-bold"><span class="text-[#008000]">Apps</span><span class="text-white">MD</span> <span class="text-[#0000ff]">& Gaya Belajar</span></h1>
                    <h3 class="text-xl leading-tight mt-2 font-semibold italic ">Aplikasi Mengenal Diri</h3>
                </div>
                @if (Session::has('message'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {{ Session::get("message") }}
                </div>
                @endif
                <div class="mb-10">
                    <h5 class="font-semibold ml-6 mb-3"><span class="text-lg">LOG IN</span></h5>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="username" class="text-xs uppercase font-semibold">Username*</label>
                        <input type="text" value="{{ old("username") }}" required id="username" name="username" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Username">
                        @error("username")
                        <p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('username') }}</p>
                        @enderror
                    </div>
                    <div class="bg-white rounded-lg py-3 px-5 mb-3">
                        <label for="password" class="text-xs uppercase font-semibold">Password*</label>
                        <input type="password" required id="password" name="password" class="px-0 block border-0 w-full hover:border-0 focus:ring-0 leading-tight text-lg" placeholder="Masukkan Password">
                        @error("password")
                        <p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('password') }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center mt-4 mb-2">
                        <input id="remember_me" type="checkbox" {{ old('remember_me') ? 'checked' : '' }} value="1" name="remember_me" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="remember_me" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">Remember Me</label>
                    </div>
                </div>
                <button type="submit" class=" w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Kirim</button>
            </div>
        </form>
    </div>
@include('layout.footer')