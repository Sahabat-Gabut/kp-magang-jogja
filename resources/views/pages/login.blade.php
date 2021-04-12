<x-guest-layout title="login">
    <main class="mt-4 flex-col">
        <div class="col-span-6 text-center">
            <h2 class="mb-2">Login menggunakan Akun Jogja Smart Service</h2>
            <h4 class="italic">Jika belum punya akun Jogja Smart Service silahkan Register <a class="text-diskominfo-light underline" href="https://jss.jogjakota.go.id/homepage?register=true">disini</a></h4>
        </div>
    </main>
    <div class="banner justify-center py-16" style="background: url('/assets/img/hero-bg.png')">
        <div class="container max-w-screen-md mx-auto items-center">
            <div class="border border-gray-300 rounded-sm">
                <div class="bg-gray-100 p-4 border-b border-gray-300">
                    <span>Login Website</span>
                </div>
                <div class="p-4 bg-white"> 
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="flex items-center">
                            <x-label for="username" class="w-60" :value="__('Username JSS')" />
                            <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" autofocus />
                        </div>
                        <div class="flex items-center mt-2">
                            <x-label for="login" class="w-60" :value="__('Password')" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" />
                        </div>
                            <div class="block mt-4 ml-44">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-diskominfo-base shadow-sm focus:bg-diskominfo-light focus:ring focus:ring-diskominfo-light focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                        <button class="py-2 px-7 ml-44 mt-2 bg-diskominfo-base text-white uppercase rounded-sm hover:bg-diskominfo-light font-semibold inline-block text-sm focus:outline-diskominfo-light focus:outline-none">
                            Login
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>