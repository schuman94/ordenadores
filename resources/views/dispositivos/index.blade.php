<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dispositivos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-x-20">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Código
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Colocado
                                        </th>
                                        <th colspan="3" scope="col" class="px-6 py-3">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dispositivos as $dispositivo)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{ route('dispositivos.show', $dispositivo) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    {{ $dispositivo->codigo }}
                                                </a>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $dispositivo->nombre }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $dispositivo->colocable->codigo }}
                                            </td>
                                            <td class="px-6 py-4 flex items-center gap-2">
                                                <a href="{{ route('dispositivos.edit', $dispositivo) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    Editar
                                                </a>
                                                <form method="POST" action="{{ route('dispositivos.destroy', $dispositivo) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                                        onclick="return confirm('¿Está seguro?');">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('dispositivos.create') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Crear una nueva dispositivo
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
