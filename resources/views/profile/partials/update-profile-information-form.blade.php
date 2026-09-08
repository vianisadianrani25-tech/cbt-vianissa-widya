<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="photo" :value="__('Profile Photo')" />

            <div class="mt-2 flex items-center gap-4">
                <div style="width: 64px; height: 64px; min-width: 64px;" class="shrink-0 overflow-hidden rounded-full bg-gray-100 ring-2 ring-gray-200">
                    <img
                        id="photo-preview"
                        src="{{ $user->photo ? $user->photoUrl() : '' }}"
                        alt="{{ $user->name }}"
                        class="h-full w-full object-cover {{ $user->photo ? '' : 'hidden' }}"
                    >
                    <div
                        id="photo-fallback"
                        class="flex h-full w-full items-center justify-center text-xl font-semibold text-gray-500 {{ $user->photo ? 'hidden' : '' }}"
                    >
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="flex-1">
                    <input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100" />
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG, atau WEBP. Maksimal 2 MB.</p>
                    <p id="photo-client-error" class="mt-1 hidden text-xs font-semibold text-red-600">Ukuran foto maksimal 2 MB.</p>
                    </div>
                </div>

            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <script>
        document.getElementById('photo')?.addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('photo-preview');
            const fallback = document.getElementById('photo-fallback');
            const error = document.getElementById('photo-client-error');

            if (!file) {
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                event.target.value = '';
                error.classList.remove('hidden');
                return;
            }

            error.classList.add('hidden');

            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            fallback.classList.add('hidden');
        });
    </script>
</section>
