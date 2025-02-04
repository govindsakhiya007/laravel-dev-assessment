<div class="container mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Skills</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Skills Table -->
        <div class="lg:col-span-2 bg-white rounded shadow-md p-4">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left font-semibold">Name</th>
                        <th class="px-4 py-2 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($skills as $skill)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $skill->name }}</td>
                            <td class="px-4 py-2 text-right">
                                <button wire:click="editSkill({{ $skill->id }})" class="text-blue-500 hover:underline mr-2">Edit</button>
                                <button wire:click="deleteSkill({{ $skill->id }})" class="text-red-500 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-4 py-2 text-center">No skills available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Form -->
        <div class="bg-white rounded shadow-md p-4">
            <h2 class="text-lg font-semibold mb-4">Add new skill</h2>
            <form wire:submit.prevent="saveSkill">
                <div class="mb-4">
                    <input type="text" wire:model.defer="name" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" placeholder="Skill name">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">
                    {{ $editSkillId ? 'Update Skill' : 'Save' }}
                </button>
            </form>
        </div>
    </div>
</div>
