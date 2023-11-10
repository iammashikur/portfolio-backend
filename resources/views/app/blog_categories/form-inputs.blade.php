@php $editing = isset($blogCategory) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $blogCategory->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $blogCategory->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
