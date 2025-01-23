<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-4 lg:gap-8 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('grants') }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $grantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Total Applications</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'pending']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $pendingGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Pending Applications</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'awaiting_verification']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $awaitingGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Grants Awaiting Verification</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'approved']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $approvedGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Grants Approved</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'rejected']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $rejectedGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Rejected Applications</p>
            </div>
        </a>
        <a href="{{ route('users') }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $usersCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Total Applicants</p>
            </div>
        </a>
        <a href="{{ route('all-messages') }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $messagesCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Total Messages</p>
            </div>
        </a>
        <a href="{{ route('admins') }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $adminsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Admins</p>
            </div>
        </a>
    </div>
</x-app-layout>
