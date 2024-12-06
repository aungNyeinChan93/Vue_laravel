@extends('layout.layout')

@section('content')
    <div class="container px-10 w-full h-screen mt-10 mx-auto ">
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Update</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Create Date</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $key => $user)
                            <tr class=" hover:bg-gray-200">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->email }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">Default Role</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->updated_at->diffForHumans() }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
               <span class="">{{ $users->links() }}</span>
            </div>
        </div>
    </div>
@endsection
