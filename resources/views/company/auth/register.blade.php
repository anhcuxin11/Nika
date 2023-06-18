<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('company.register') }}">
            @csrf

            <!-- Company no -->
            <div>
                <x-label for="company_no" :value="__('Company no')" />

                <x-input id="company_no" class="block mt-1 w-full" type="text" name="company_no" :value="old('company_no')" required autofocus />
            </div>

            <!-- Company name -->
            <div>
                <x-label for="name" :value="__('Company name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Company address -->
            <div class="mt-4">
                <x-label for="address" :value="__('Company address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
            </div>

            <!-- Company phone -->
            <div class="mt-4">
                <x-label for="phone_company" :value="__('Company phone')" />

                <x-input id="phone_company" class="block mt-1 w-full" type="text" name="phone_company" :value="old('phone_company')" required autofocus />
            </div>

            <!-- Company email -->
            <div class="mt-4">
                <x-label for="email_company" :value="__('Company email')" />

                <x-input id="email_company" class="block mt-1 w-full" type="text" name="email_company" :value="old('email_company')" required autofocus />
            </div>

            <!-- Company fax -->
            <div class="mt-4">
                <x-label for="fax_company" :value="__('Company fax')" />

                <x-input id="fax_company" class="block mt-1 w-full" type="text" name="fax_company" :value="old('fax_company')" required autofocus />
            </div>

            <!-- Name person -->
            <div class="mt-4">
                <x-label for="name_person" :value="__('Name person')" />

                <x-input id="name_person" class="block mt-1 w-full" type="text" name="name_person" :value="old('name_person')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email person')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            {{-- <div class="mt-4">
                <div class="custom-file single-upload">
                    <input type="file" id="curriculum_vitae" @change="handleFile" id="customFile" name="attachment" accept=".doc,.pdf,.docx,.xlsx,.xls,.txt" class="custom-file-input">
                    <div class="custom-file-seletor ">
                        <button type="button" class="btn custom-file-button">Choose</button>
                        <label for="curriculum_vitae" class="custom-file-name ">Upload curriculum vitae'
                        </label>
                    </div>
                </div>
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('company.login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
