<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applicant Profile') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 lg:gap-8 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3 lg:gap-8 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
            <div>
                <h2 class="text-xl font-semibold text-black">Bio-data</h2>

                <p class="mt-4 text-sm/relaxed"><span class="font-bold">Full Name:</span> {{ $user->full_name }}</p>
                <p class="mt-4 text-sm/relaxed"><span class="font-bold">Email:</span> {{ $user->email }}</p>
                <p class="mt-4 text-sm/relaxed"><span class="font-bold">Phone No:</span> {{ $user->phone_no }}</p>
                <p class="mt-4 text-sm/relaxed"><span class="font-bold">Campaign:</span> {{ $user->campaign }}</p>
                <p class="mt-4 text-sm/relaxed"><span class="font-bold">Signup Reason:</span> {{ $user->signup_reason }}</p>
                <p class="mt-4 text-sm/relaxed"><span class="font-bold">Profile Status:</span> {{ \Str::ucfirst($user->status) }}</p>
                <p class="mt-4 text-sm/relaxed">
                    @if ($user->status == 'active')
                    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{ route('user.update-status', ['uuid' => $user->id, 'status' => 'suspended']) }}">Suspend User</a>
                    @else
                    <a class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{ route('user.update-status', ['uuid' => $user->id, 'status' => 'active']) }}">Activate User</a>
                    @endif
                
                    <a class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{ route('user.update-status', ['uuid' => $user->id, 'status' => 'delete']) }}">Delete User</a>
                </p>
            </div>
        </div>
        <div class="rounded-lg bg-white overflow-hidden p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
            <h2 class="text-xl font-semibold text-black mb-8">Applicant's Application</h2>
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
                    @foreach($user->grants as $grant)
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
</x-app-layout>
