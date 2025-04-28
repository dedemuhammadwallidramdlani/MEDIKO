<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('transaksi.store') }}">
                        @csrf
                
                        <!-- Input fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="obat_id" :value="__('Obat ID')" />
                                <x-text-input id="obat_id" class="block mt-1 w-full" type="text" name="obat_id" :value="old('obat_id')" required autofocus autocomplete="nama_obat" />
                                <x-input-error :messages="$errors->get('obat_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jumlah" :value="__('Jumlah')" />
                                <x-text-input id="jumlah" class="block mt-1 w-full" type="text" name="jumlah" :value="old('jumlah')" required autofocus autocomplete="deskripsi" />
                                <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Tanggal Transaksi dan Total Harga Sejajar -->
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="tanggal_transaksi" :value="__('Tanggal Transaksi')" />
                                <x-text-input id="tanggal_transaksi" class="block mt-1 w-full" type="date" name="tanggal_transaksi" :value="old('tanggal_transaksi')" required autofocus autocomplete="stok" />
                                <x-input-error :messages="$errors->get('tanggal_transaksi')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="total_harga" :value="__('Total Harga')" />
                                <x-text-input id="total_harga" class="block mt-1 w-full" type="text" name="total_harga" :value="old('total_harga')" required autofocus autocomplete="harga" />
                                <x-input-error :messages="$errors->get('total_harga')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Add button -->
                        <div class="mt-4">
                            <button type="button" id="add-btn" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                {{ __('Add to Table') }}
                            </button>
                        </div>

                        <!-- Items Table -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Items to be Added</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                                    <thead class="bg-gray-100 dark:bg-gray-600">
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Obat ID</th>
                                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Jumlah</th>
                                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Tanggal Transaksi</th>
                                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Total Harga</th>
                                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-table-body">
                                        <!-- Items will be added here dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Total Sub Total with box around Rp -->
                        <div class="mt-4 flex justify-end">
                            <div>
                                <strong class="text-lg">Total Sub Total</strong>
                                <div class="mt-2 flex items-center justify-end border border-gray-300 dark:border-gray-600 rounded p-4">
                                    <span class="text-lg font-semibold">Rp</span>
                                    <span id="total-sub-total" class="ml-2 text-lg font-semibold">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input to store the items data -->
                        <input type="hidden" name="items" id="items-data">
                
                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('transaksi.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4" type="submit">
                                {{ __('Save All') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-btn');
            const itemsTableBody = document.getElementById('items-table-body');
            const itemsDataInput = document.getElementById('items-data');
            const totalSubTotalElement = document.getElementById('total-sub-total');  // Elemen untuk menampilkan total sub total
            
            let items = [];
            
            addBtn.addEventListener('click', function() {
                const obatId = document.getElementById('obat_id').value;
                const jumlah = document.getElementById('jumlah').value;
                const tanggalTransaksi = document.getElementById('tanggal_transaksi').value;
                const totalHarga = document.getElementById('total_harga').value;
                
                if (!obatId || !jumlah || !tanggalTransaksi || !totalHarga) {
                    alert('Please fill all fields');
                    return;
                }
                
                // Calculate Sub Total
                const subTotal = parseFloat(jumlah) * parseFloat(totalHarga);
                
                // Add item to array
                const newItem = {
                    obat_id: obatId,
                    jumlah: jumlah,
                    tanggal_transaksi: tanggalTransaksi,
                    total_harga: totalHarga,
                    sub_total: subTotal
                };
                
                items.push(newItem);
                updateItemsTable();
                updateHiddenInput();
                
                // Clear input fields
                document.getElementById('obat_id').value = '';
                document.getElementById('jumlah').value = '';
                document.getElementById('total_harga').value = '';
                document.getElementById('obat_id').focus();
            });
            
            function updateItemsTable() {
                itemsTableBody.innerHTML = '';
                
                items.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">${item.obat_id}</td>
                        <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">${item.jumlah}</td>
                        <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">${item.tanggal_transaksi}</td>
                        <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">${item.total_harga}</td>
                        <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">
                            <button type="button" class="text-red-500 hover:text-red-700 remove-btn" data-index="${index}">
                                Remove
                            </button>
                        </td>
                    `;
                    itemsTableBody.appendChild(row);
                });
                
                // Update total sub total
                updateTotalSubTotal();
                
                // Add event listeners to remove buttons
                document.querySelectorAll('.remove-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        items.splice(index, 1);
                        updateItemsTable();
                        updateHiddenInput();
                    });
                });
            }
            
            function updateTotalSubTotal() {
                const totalSubTotal = items.reduce((sum, item) => sum + item.sub_total, 0);
                totalSubTotalElement.textContent = totalSubTotal.toFixed(2);
            }
            
            function updateHiddenInput() {
                itemsDataInput.value = JSON.stringify(items);
            }
        });
    </script>
</x-app-layout>
