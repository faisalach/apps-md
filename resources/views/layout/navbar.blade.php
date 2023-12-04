@include('layout.header')
<nav class="bg-green-400 border-gray-200 dark:bg-gray-900 fixed z-40 top-0 left-0 w-full">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" /> --}}
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Apps MD</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <i class="fas fa-fw fa-bars text-gray-500 fa-lg"></i>
            </button>
        </div>
    </div>
</nav>

 
 <aside id="default-sidebar" style="height: calc(100vh - 64px);top:64px;" class="fixed left-0 z-40 w-64 transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-green-200 dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
          <li>
             <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-fw fa-dashboard text-gray-500"></i>
                <span class="ms-3">Dashboard</span>
             </a>
          </li>
          <li>
             <a href="{{ route('contact') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-fw fa-address-book text-gray-500"></i>
                <span class="ms-3">Contact</span>
             </a>
          </li>
          <li>
             <a href="{{ route('settings') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-fw fa-cogs text-gray-500"></i>
                <span class="ms-3">Settings</span>
             </a>
          </li>
          <li>
             <a href="{{ route('logout') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-fw fa-sign-out-alt text-gray-500"></i>
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
 