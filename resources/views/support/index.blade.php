<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Support Tickets') }}
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
                                <x-table-col-name value="{{ __('Email') }}" />
                            </th>
                            <th>
                                <x-table-col-name value="{{ __('Title') }}" />
                            </th>
                            <th data-type="date" data-format="YYYY/DD/MM">
                                <x-table-col-name value="{{ __('Date') }}" />
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>#{{ \Illuminate\Support\Str::substr($message->id, 0, 8) }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->title }}</td>
                            <td>{{ $message->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
