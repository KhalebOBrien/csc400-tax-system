<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Personal Filings') }}
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
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-end px-4 py-3 text-end">
            <a href="{{ route('filing.personal.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">File A Record</a>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <table id="default-table">
                <thead>
                    <tr>
                        <th>
                            <x-table-col-name value="{{ __('ID') }}" />
                        </th>
                        <th>
                            <x-table-col-name value="{{ __('Amount Filed') }}" />
                        </th>
                        <th>
                            <x-table-col-name value="{{ __('Period Filed') }}" />
                        </th>
                        <th>
                            <x-table-col-name value="{{ __('Payment Status') }}" />
                        </th>
                        <th data-type="date" data-format="YYYY/DD/MM">
                            <x-table-col-name value="{{ __('Filed On') }}" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td>#{{ \Str::substr($record->id, 0, 8) }}</td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ \Number::currency($record->computed_tax_amount, 'NGN') }}</td>
                        <!-- <td><a href="{{ $record->verification_url }}" target="_blank">{{ $record->verification_url }}</a></td> -->
                        <td>{{ $record->income_duration_start_date.' to '.$record->income_duration_end_date }}</td>
                        <td>{{ \Str::ucfirst($record->payment_status) }}</td>
                        <td>{{ $record->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
