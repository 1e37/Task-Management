<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4 text-lg font-bold">Willkommen im Task-Management-System</h3>

                    <!-- Create Project Button -->
                    <div class="mb-4">
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 transition ease-in-out duration-150">
                            Neues Projekt erstellen
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="p-4 bg-blue-100 rounded">
                            <h4 class="font-bold">Offene Aufgaben</h4>
                            <p class="text-2xl">{{ $openTasksCount }}</p>
                        </div>

                        <div class="p-4 bg-green-100 rounded">
                            <h4 class="font-bold">Aktive Projekte</h4>
                            <p class="text-2xl">{{ $activeProjects->count() }}</p>
                            <ul>
                                @foreach($activeProjects as $project)
                                    <li>
                                        <strong>{{ $project->name }}</strong>: {{ $project->description }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-4 bg-yellow-100 rounded">
                            <h4 class="font-bold">Fällige Aufgaben</h4>
                            <p class="text-2xl">{{ $idletasks }}</p>
                            <ul>
                                @foreach($dueTasks as $task)
                                    <li>
                                        <strong>{{ $task->name }}</strong>: {{ $task->description }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
