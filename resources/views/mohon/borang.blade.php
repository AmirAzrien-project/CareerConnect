<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Permohonan Pelajar') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md overflow-hidden">

                <!-- Redirect Button -->
                <div class="mb-4">
                    <a href="{{ route('mohon.create') }}"
                        class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        {{ __('Permohonan Baru') }}
                    </a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('mohon.borang') }}"
                        class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        {{ __('Borang SLI-01 Pelajar') }}
                    </a>
                </div>


                <!-- Table -->
                <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Document</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($mohons as $mohon)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-300">{{ $mohon->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $mohon->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ \Carbon\Carbon::parse($mohon->date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                @if($mohon->dokumen_mohon)
                                <a href="{{ asset('storage/dokumen/'.$mohon->dokumen_mohon) }}" target="_blank"
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300 ease-in-out">
                                    View Document
                                </a>
                                @else
                                <span class="text-gray-500">No Document</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <!-- Status column with color coding -->
                                <span class="px-3 py-1 text-xs font-semibold rounded 
                                    @if($mohon->status == 'approved') bg-green-200 text-green-800 
                                    @elseif($mohon->status == 'declined') bg-red-200 text-red-800 
                                    @elseif($mohon->status == 'pending') bg-yellow-200 text-yellow-800 
                                    @endif">
                                    {{ ucfirst($mohon->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                @if($mohon->status == 'pending')
                                <form action="{{ url('/mohon/'.$mohon->id.'/status') }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="approved"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500" title="Approve">
                                        <i class="fas fa-check-circle mr-2"></i>
                                    </button>
                                </form>
                                <form action="{{ url('/mohon/'.$mohon->id.'/status') }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="declined"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" title="Decline">
                                        <i class="fas fa-times-circle mr-2"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>