<div class="p-8">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Skills Management</h1>

        @if (session()->has('message'))
            <div class="text-green-600 mb-4">{{ session('message') }}</div>
        @endif

        <div class="flex mb-4">
            <input type="text" wire:model="name" placeholder="Skill name"
                   class="border rounded p-2 w-full mr-2 focus:outline-none">
            <button wire:click="saveSkill"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ $editId ? 'Update' : 'Save' }}
            </button>
            @if ($editId)
                <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 hover:bg-gray-700">
                    Cancel
                </button>
            @endif
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Name</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($skills as $skill)
                    <tr>
                        <td class="border p-2">{{ $skill->name }}</td>
                        <td class="border p-2 text-center">
                            <button wire:click="editSkill({{ $skill->id }})"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-700 mr-2">
                                Edit
                            </button>
                            <button wire:click="deleteSkill({{ $skill->id }})"
                                    class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
