<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grant Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                <x-table-col-name value="{{ __('Expected Funding') }}" />
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
                        @foreach($grants as $grant)
                        <tr>
                            <td>#{{ \Str::substr($grant->id, 0, 8) }}</td>
                            <td><a href="{{ route('grant.show', $grant->id) }}">{{ $grant->full_name }}</a></td>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $grant->expected_funding }}</td>
                            <td><a href="{{ $grant->verification_url }}" target="_blank">{{ $grant->verification_url }}</a></td>
                            <td>{{ \Str::ucfirst($grant->status) }}</td>
                            <td>{{ $grant->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
