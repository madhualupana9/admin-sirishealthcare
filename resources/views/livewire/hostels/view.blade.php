<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Hostel Details</h2>
                        <a href="{{ route('hospitals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-800 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Back to List
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($hostel->image)
                                <img src="{{ asset($hostel->image) }}" alt="{{ $hostel->hospital_name }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                                    No Image Available
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $hostel->hospital_name }}</h3>
                                <p class="text-gray-600">{{ $hostel->city }}, {{ $hostel->state }}</p>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-md font-medium text-gray-700">Contact Information</h4>
                                <p class="text-gray-600">{{ $hostel->contact_number ?? 'Not provided' }}</p>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-md font-medium text-gray-700">Status</h4>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $hostel->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $hostel->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div>
                                <h4 class="text-md font-medium text-gray-700">Description</h4>
                                <p class="text-gray-600 whitespace-pre-line">{{ $hostel->description ?? 'No description available' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('hospitals.edit', $hostel) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
