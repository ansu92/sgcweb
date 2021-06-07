<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Banco') }}
        </h2>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container flex flex-col mx-auto mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class=" w-3/4 mx-auto my-2 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="p-2">
                        {{-- {{ $bancos->links() }} --}}
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NOMBRE
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($bancos as $item)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {{ $item->nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <div class="p-2">
                        {{-- {{ $bancos->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
