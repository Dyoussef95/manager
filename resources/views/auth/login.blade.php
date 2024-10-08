<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
        <x-application-logo/>
        <h1 class="h3 mb-3 fw-normal">Por favor inicie sesión</h1>
            @csrf

            <!-- Email Address -->
            <div class="form-floating">
                 <x-input id="email" class="form-control" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            placeholder="name@example.com" required/>
                 <x-label for="email" :value="__('Email')" />
            </div>

            <!-- Password -->
            <div class="form-floating">
                

                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                placeholder="password" required/>
                <x-label for="password" :value="__('Contraseña')" />
            </div>

            <!-- Remember Me -->
            <div class="form-check text-start my-3">
                <x-input id="remember_me" class="form-check-input"
                                type="checkbox"
                                name="remember"/>

                <x-label for="remember_me" class="form-check-label" :value="__('Recuérdame')" />               
                
            </div>

            <x-button class="btn btn-primary w-100 py-2">
                    {{ __('Iniciar sesión') }}
            </x-button>
            <p class="mt-5 mb-3 text-body-secondary"><a href="https://ehideas.com/">© eh! ideas 2024 https://ehideas.com</a>
            </p>
        </form>
    </x-auth-card>
</x-guest-layout>
