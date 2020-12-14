        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 py-2 text-center">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <form wire:submit.prevent="upload">
                        {{ $naTela }}
                        <input wire:model="attachment" type="file" name="attachment" id="attachment" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" />
                        <button type="submit" class="px-6 rounded-r-lg bg-yellow-400 text-gray-800 font-bold p-3 uppercase border-yellow-500 border-t border-b border-r">
                            Upload de arquivo XML para processamento
                        </button>
                        @error('attachment')
                        <p class="mt-2 text-sm text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </form>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress" class="bg-green-500 absolute"></progress>
                    </div>
                </div>                
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
                    <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                        <table wire:poll.5s class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Arquivo</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Tamanho</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Registros</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Tipo</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Por</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Em</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-100 text-left text-sm leading-4 text-blue-500 tracking-wider">Status</th>
                                    {{-- <th class="px-6 py-3 border-b-2 border-gray-100"></th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($files as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-100">
                                        <div class="text-sm leading-5 text-blue-900">{{ $file->original_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-100 text-sm leading-5">{{ $file->size }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-100 text-sm leading-5">{{ $file->records }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-100 text-sm leading-5">{{ $file->type }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-100 text-sm leading-5">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-100 text-sm leading-5">{{ $file->created_at->format('d/m/Y') }} às {{ $file->created_at->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-100 text-sm leading-5">
                                        @if ($file->status == $status_waiting)
                                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                            <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                            <span class="relative text-xs">Pendente</span>
                                        </span>
                                        @elseif ($file->status == $status_progress)
                                        <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                                            <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                            <span class="relative text-xs">Em progresso</span>
                                        </span>
                                        @else
                                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                            <span class="relative text-xs">Processado</span>
                                        </span>
                                        @endif
      
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-100 text-sm leading-5">
                                        @if ($file->status == $status_processed)
                                        <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">...</button>
                                        @endif
                                    </td> --}}
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 whitespace-no-wrap border-b border-gray-100">
                                        <div class="flex items-center">
                                            Nenhum registro encontrado.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                            <div>
                                <nav class="relative z-0 inline-flex shadow-sm">
                                    {{ $files->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
