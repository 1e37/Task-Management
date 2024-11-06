<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4 text-lg font-bold flex items-center justify-center ">Neues Projekt erstellen und an
                        User zuweisen:</h3>
                    <div class="container pb-8 pt-8">
                        {{-- <h1>Neues Projekt erstellen</h1> --}}

                        @if (session('erfolg'))
                            <div class="alert alert-success">
                                {{ session('erfolg') }}
                            </div>
                        @endif
                        {{-- Trigger the post method in the route --}}

                        {{-- Project Data --}}
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf
                            {{-- name --}}
                            <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md hover:bg-lime-300">
                                <div class="mb-4">
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700">Projektname</label>
                                    <input type="text"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="name" id="name" required>
                                </div>
                                {{-- description --}}
                                <div class="mb-4">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Beschreibung</label>
                                    <textarea
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="description" id="description"></textarea>
                                </div>
                                {{-- status --}}
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="status" id="status" required>
                                        <option value="aktiv">Aktiv</option>
                                        <option value="abgeschlossen">Abgeschlossen</option>
                                        <option value="pausiert">Pausiert</option>
                                    </select>
                                </div>
                            </div>
                    </div>

                    {{-- Related Tasks Data --}}
                    <div class="container pb-8 pt-8">
                        <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md hover:bg-lime-300">
                            <div id="tasks-container">
                                <!-- Existing Task Card -->
                                <h3 class="flex items-center justify-center mt-5 mb-4 text-lg font-bold">Task 1:</h3>
                                <div class="task mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Task Title</label>
                                    <input type="text"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="task_title[0]" required>

                                    <label class="block text-sm font-medium text-gray-700">Task Description</label>
                                    <textarea
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="task_description[0]"></textarea>

                                    <label class="block text-sm font-medium text-gray-700">Task Status</label>
                                    <select
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="task_status[0]" required>
                                        <option value="neu">Neu</option>
                                        <option value="in_bearbeitung">In Bearbeitung</option>
                                        <option value="abgeschlossen">Abgeschlossen</option>
                                    </select>

                                    <label class="block text-sm font-medium text-gray-700">Task Priority</label>
                                    <select
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="task_priority[0]" required>
                                        <option value="hoch">Hoch</option>
                                        <option value="mittel">Mittel</option>
                                        <option value="niedrig">Niedrig</option>
                                    </select>

                                    <label class="block text-sm font-medium text-gray-700">Task Due Date</label>
                                    <input type="date"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="task_due_date[0]" required>

                                    <label class="block text-sm font-medium text-gray-700">Assign User</label>
                                    <select
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                        name="assigned_to[0]" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <button type="button" id="add-task"
                                class="mt-4 bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                Weitere Aufgabe hinzufügen
                            </button>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="mt-4 bg-emerald-500 text-white p-2 rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300">
                                Projekt erstellen
                            </button>
                        </div>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script>
      let taskIndex = 1; // Start from 1 since 0 is already used

document.getElementById('add-task').addEventListener('click', function() {
    const tasksContainer = document.getElementById('tasks-container');

    // Create a new task div
    const newTaskDiv = document.createElement('div');
    newTaskDiv.classList.add('task', 'mb-4');

    newTaskDiv.innerHTML = `
        <h3 class="flex items-center justify-center mt-5 mb-4 text-lg font-bold">Task ${taskIndex + 1}:</h3>
        <label class="block text-sm font-medium text-gray-700">Task Title</label>
        <input type="text" name="task_title[${taskIndex}]" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">

        <label class="block text-sm font-medium text-gray-700">Task Description</label>
        <textarea name="task_description[${taskIndex}]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"></textarea>

        <label class="block text-sm font-medium text-gray-700">Task Status</label>
        <select name="task_status[${taskIndex}]" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            <option value="neu">Neu</option>
            <option value="in_bearbeitung">In Bearbeitung</option>
            <option value="abgeschlossen">Abgeschlossen</option>
        </select>

        <label class="block text-sm font-medium text-gray-700">Task Priority</label>
        <select name="task_priority[${taskIndex}]" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            <option value="hoch">Hoch</option>
            <option value="mittel">Mittel</option>
            <option value="niedrig">Niedrig</option>
        </select>

        <label class="block text-sm font-medium text-gray-700">Task Due Date</label>
        <input type="date" name="task_due_date[${taskIndex}]" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">

        <label class="block text-sm font-medium text-gray-700">Assign User</label>
        <select name="assigned_to[${taskIndex}]" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    `;

    tasksContainer.appendChild(newTaskDiv);
    taskIndex++; // Increment the index for the next task
});
    </script>

</x-app-layout>
