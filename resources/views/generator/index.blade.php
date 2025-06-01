<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Generate Laravel Package
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-600 dark:text-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 text-red-600 dark:text-red-400">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('generator.generate') }}">
                    @csrf

                    <!-- Module Name Field -->
                    <div class="mb-4">
                        <label for="module_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Module Name (e.g., Blog, Product)
                        </label>
                        <input id="module_name" name="module_name" type="text" required
                            class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white"
                            value="{{ old('module_name') }}">
                    </div>

                    <!-- SQL Input -->
                    <div class="mb-4">
                        <label for="sql" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            CREATE TABLE SQL
                        </label>
                        <textarea id="sql" name="sql" rows="10" required
                            class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">{{ old('sql') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Generate & Download
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
