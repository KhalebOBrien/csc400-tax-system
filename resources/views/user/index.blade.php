<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Users') }}
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
                                <x-table-col-name value="{{ __('Role') }}" />
                            </th>
                            <th>
                                <x-table-col-name value="{{ __('Status') }}" />
                            </th>
                            <th data-type="date" data-format="YYYY/DD/MM">
                                <x-table-col-name value="{{ __('Joined On') }}" />
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>#{{ \Str::substr($user->id, 0, 8) }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}">{{ $user->full_name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ \Str::ucfirst($user->role) }}</td>
                            <td>{{ \Str::ucfirst($user->status) }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
