<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar dispositivo
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('dispositivos.update', $dispositivo) }}" class="max-w-sm mx-auto">
                @method('PUT')
                @csrf
                <div class="mb-5">
                    <x-input-label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Código
                    </x-input-label>
                    <x-text-input name="codigo" type="text" id="codigo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('codigo', $dispositivo->codigo)" />
                    <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <x-input-label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nombre
                    </x-input-label>
                    <x-text-input name="nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('nombre', $dispositivo->nombre)" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <x-input-label for="colocable_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Colocar en
                    </x-input-label>
                    <select name="colocable_type" id="colocable_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="App\Models\Ordenador" @selected(old('colocable_type', get_class($dispositivo->colocable)) === 'App\Models\Ordenador')>
                            Ordenador
                        </option>
                        <option value="App\Models\Aula" @selected(old('colocable_type', get_class($dispositivo->colocable)) === 'App\Models\Aula')>
                            Aula
                        </option>
                    </select>
                </div>
                <div class="mb-5">
                    <x-input-label for="colocable_codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Código
                    </x-input-label>
                    <x-text-input name="colocable_codigo" type="text" id="colocable_codigo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('colocable_codigo', $dispositivo->colocable->codigo)" />
                    <x-input-error :messages="$errors->get('colocable_codigo')" class="mt-2" />
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Editar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
