@props(['name', 'accept' => 'image/*'])

<div x-data="{
    imageUrl: null,
    fileChosen(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => this.imageUrl = e.target.result;
            reader.readAsDataURL(file);
        } else {
            this.imageUrl = null;
        }
    }
}"
    class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200">

    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="{{ $accept }}" class="hidden"
        @change="fileChosen">

    <label for="{{ $name }}" class="cursor-pointer block">
        <div x-show="!imageUrl">
            <div class="text-gray-400 dark:text-gray-500 mb-2">
                <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold text-indigo-600 dark:text-indigo-400">Klik untuk upload</span> atau drag and
                drop
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PNG, JPG, JPEG hingga 2MB</p>
        </div>

        <div x-show="imageUrl" style="display: none;" class="mt-2">
            <img :src="imageUrl" alt="Preview"
                class="max-w-full h-40 object-cover rounded-lg mx-auto shadow-md border border-gray-200 dark:border-gray-700">
            <p class="text-xs text-indigo-500 mt-2 font-medium">Klik gambar untuk mengganti file</p>
        </div>
    </label>
</div>
