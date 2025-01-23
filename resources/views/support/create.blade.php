<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Support Ticket') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form method="POST" enctype="multipart/form-data" action="{{ route('message.store') }}">
                @csrf
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-section-title>
                        <x-slot name="title">{{ __('Open New Ticket') }}</x-slot>
                        <x-slot name="description">{{ __('Have a question or need help?') }}</x-slot>
                    </x-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="{{ __('Full Name') }}" required />
                                    <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name') ?? $user->full_name" required autocomplete="name" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="email" value="{{ __('Email') }}" required />
                                    <x-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email') ?? $user->email" required autocomplete="email" />
                                    <x-input-error for="email" class="mt-2" />
                                </div>
                                <!-- Title -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="title" value="{{ __('Title') }}" required />
                                    <x-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autocomplete="title" />
                                    <x-input-error for="title" class="mt-2" />
                                </div>
                                <!-- Message -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="message" value="{{ __('Message') }}" required />
                                    <x-textarea id="message" class="mt-1 block w-full h-40" name="message" :value="old('message')" required />
                                    <x-input-error for="message" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <x-button wire:loading.attr="disabled" wire:target="photo">
                                {{ __('Submit Application') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
