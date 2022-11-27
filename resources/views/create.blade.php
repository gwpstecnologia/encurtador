<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Encurtar URL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @include('layouts.includes.msg')
                    <div class="mt-6 text-gray-500">
                        <form method="POST" action="{{route('create_post')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="destination" class="form-label">URL</label>
                                <input type="URL" class="form-control" name="destination" id="destination" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="personalizar" id="personalizar">
                                <label class="form-check-label" for="personalizar">Deseja personalizar o Link Curto?</label>
                            </div>
                            <div class="mb-3" id="personalizado">
                                {{route('redirect')}}/
                                <input type="text"  id="inputlink" name="link">
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Criar novo</button>
                        </form>
                    </div>
                    @if ($link = Session::get('completo'))
                    <br/> 
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong id='titulo'>Tudo certo! Clique para copiar</strong> 
                            <input onclick="copiarTexto()" class="form-control" id="LinkGerado" type="text" value="{{route('redirect').'/'.$link}}" readonly>
                        </div>
                    @endif
                </div>
            </div>
            
            </div>
        </div>
    </div>
    
    <script>
        if ($('#personalizar').prop('checked')) {
            $('#personalizado').show()
            } else {
            $('#personalizado').hide()
            }

            $("#personalizar").on("change", e => {
            const isChecked = e.target.checked;
            if (isChecked) $('#personalizado').show()
            else $('#personalizado').hide()
        })

        function copiarTexto() {
            let textoCopiado = document.getElementById("LinkGerado");
            textoCopiado.select();
            textoCopiado.setSelectionRange(0, 99999)
            document.execCommand("copy");
            document.getElementById('titulo').innerHTML = 'Copiado com sucesso!';
        }
        
    </script>

    
</x-app-layout>
