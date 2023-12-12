@include('layout.header')
<nav class="bg-blue-500 border-gray-200 fixed z-40 top-0 left-0 w-full">
	<div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
		<a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
			{{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" /> --}}
			<span class="text-white self-center text-2xl font-semibold whitespace-nowrap">Apps MD</span>
		</a>
		<div class="flex items-center space-x-6 rtl:space-x-reverse">
			@if(Auth::user()->role != "superadmin")
			<p class="font-bold text-white">
				Sisa Kuota Token : {{ CustomHelper::getKuotaToken() }}
			</p>
			@endif
			<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-inherit rounded-lg sm:hidden hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200">
				<i class="fas fa-fw fa-bars text-inherit fa-lg"></i>
			</button>
		</div>
	</div>
</nav>


<aside id="default-sidebar" style="height: calc(100vh - 64px);top:64px;" class="fixed left-0 z-40 w-64 transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
	<div class="h-full px-3 py-4 overflow-y-auto bg-gray-100">
	<ul class="space-y-2 font-medium">
		@if(Auth::guard("superadmin")->check())
		<li>
			<a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-dashboard text-inherit"></i>
				<span class="ms-3">Dashboard</span>
			</a>
		</li>
		<li>
			<a href="{{ route('dashboard.calculator') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-calculator text-inherit"></i>
				<span class="ms-3">Kalkulator</span>
			</a>
		</li>
		<li>
			<a href="{{ route('contact') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-address-book text-inherit"></i>
				<span class="ms-3">Contact</span>
			</a>
		</li>
		<li>
			<a href="{{ route('bank_soal') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-book text-inherit"></i>
				<span class="ms-3">Bank Soal</span>
			</a>
		</li>
		<li>
			<a href="{{ route('cabang') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
			<i class="fas fa-fw fa-building text-inherit"></i>
			<span class="ms-3">Cabang</span>
			</a>
		</li>
		<li>
			<a href="{{ route('users') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
			<i class="fas fa-fw fa-users text-inherit"></i>
			<span class="ms-3">User</span>
			</a>
		</li>
		@else
		<li>
			<a href="{{ route('contact') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-address-book text-inherit"></i>
				<span class="ms-3">Contact</span>
			</a>
		</li>
		@endif
		<li>
			<a href="{{ route('settings') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-cogs text-inherit"></i>
				<span class="ms-3">Settings</span>
			</a>
		</li>
		<li>
			<a href="{{ route('logout') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-blue-500 hover:text-white group">
				<i class="fas fa-fw fa-sign-out-alt text-inherit"></i>
				<span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
			</a>
		</li>
	</ul>
	</div>
</aside>

<div class="p-4 sm:ml-64 mt-16">
	@yield('navbarContent')
</div>
@include('layout.footer')
