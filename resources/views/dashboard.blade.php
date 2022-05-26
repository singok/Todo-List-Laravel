<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            To-DO List
            <span style="float: right">
                <button type="button" class="btn btn-primary" style="padding: 5px 15px">Add</button>
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire("todos")
    </div>
</x-app-layout>
