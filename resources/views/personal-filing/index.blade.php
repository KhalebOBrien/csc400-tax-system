<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Personal Filings') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                                <x-table-col-name value="{{ __('Full Name') }}" />
                            </th>
                            <th>
                                <x-table-col-name value="{{ __('Amount Filed') }}" />
                            </th>
                            <th>
                                <x-table-col-name value="{{ __('Verification URL') }}" />
                            </th>
                            <th>
                                <x-table-col-name value="{{ __('Status') }}" />
                            </th>
                            <th data-type="date" data-format="YYYY/DD/MM">
                                <x-table-col-name value="{{ __('Submitted On') }}" />
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>
                            <td>#{{ \Str::substr($record->id, 0, 8) }}</td>
                            <td><a href="{{ route('grant.show', $record->id) }}">{{ $record->full_name }}</a></td>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $record->expected_funding }}</td>
                            <td><a href="{{ $record->verification_url }}" target="_blank">{{ $record->verification_url }}</a></td>
                            <td>{{ \Str::ucfirst($record->status) }}</td>
                            <td>{{ $record->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
