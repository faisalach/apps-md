@include('layout.header')
    <div style="background-image: url('/assets/bg2.jpg')" class="min-h-screen relative flex items-center justify-center bg-repeat-y bg-cover p-4">
        <span class="fixed top-0 left-0 bottom-0 right-0 bg-gray-500 z-5 opacity-30"></span>
        <div class="relative z-10 sm:w-96 w-full bg-white shadow-lg border border-gray-100 p-3 rounded-md max-w-full m-auto px-8 py-4">
            <form action="{{ route('authenticated') }}" method="POST" >
                @csrf
                <div class="text-center pb-5 mb-5 border-b">
                    <h3 class="text-xl leading-tight mt-10 font-semibold ">Aplikasi Mengenal Diri</h3>
                    <h5 class="font-semibold mb-3 mt-4 text-gray-500">Log In</h5>
                </div>
                @if (Session::has('message'))
                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                    {{ Session::get("message") }}
                </div>
                @endif
                <div class="mb-5 pb-5 border-b border-gray-100">
                    <div class="mb-3">
                        <label for="username" class="text-xs uppercase font-semibold">Username*</label>
                        <input type="text" value="{{ old("username") }}" required id="username" name="username" class="border-b border-gray-200 px-0 block border-0 w-full focus:ring-0 leading-tight bg-transparent border-bottom" placeholder="Masukkan Username">
                        @error("username")
                        <p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('username') }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="text-xs uppercase font-semibold">Password*</label>
                        <input type="password" required id="password" name="password" class="border-b border-gray-200 px-0 block border-0 w-full focus:ring-0 leading-tight bg-transparent border-bottom" placeholder="Masukkan Password">
                        @error("password")
                        <p class="text-xs p-0 m-0 text-red-500">* {{ $errors->first('password') }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center mt-4 mb-2">
                        <input id="remember_me" type="checkbox" {{ old('remember_me') ? 'checked' : '' }} value="1" name="remember_me" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember_me" class="ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">Remember Me</label>
                    </div>
                </div>
                <button type="submit" class=" w-full focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2">Kirim</button>
            </form>
        </div>
    </div>
@include('layout.footer')