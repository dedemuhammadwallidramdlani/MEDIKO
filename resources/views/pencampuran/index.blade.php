<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pencampuran') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('pencampuran.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Cari..."
                                    class="w-full relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                            </form>
                        </div>
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('pencampuran.create') }}"
                                class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800 ">
                                <tr class="bg-white border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>No</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Obat</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Bahan baku</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Jumlah Bahan baku</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Tanggal Pencampuran</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = ($pencampuran->currentPage() - 1) * $pencampuran->perPage() + 1;
                                @endphp
                                @forelse($pencampuran as $item) {{-- Ganti $pencampuran menjadi $item --}}
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ $i++ }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $item->obat_id }} {{-- Ganti $pencampuran menjadi $item --}}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $item->bahanbaku_id }} {{-- Ganti $pencampuran menjadi $item --}}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $item->jumlah_bahanbaku }} {{-- Ganti $pencampuran menjadi $item --}}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $item->tanggal_pencampuran }} {{-- Ganti $pencampuran menjadi $item --}}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('pencampuran.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('pencampuran.edit', $item->id) }}" class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $item->id }})" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Data Belum Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="relative p-3">
                            {{ $pencampuran->links() }} {{-- Pastikan ini berada di luar loop --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(obat_id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + obat_id).submit();
                }
            });
        }
    </script>
</x-app-layout>