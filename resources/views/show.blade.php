<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exibindo URL\'s') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @include('layouts.includes.msg')          
                    <div class="mt-6 text-gray-500">
                    @isset($links) 
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Link:</th>
                                <th scope="col">Destino</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Ação</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $link)
                                <tr>
                                    <td>{{$link->link}}</td>
                                    <td>{{$link->destination}}</td>
                                    <td>{{$link->title}}</td>
                                    <td>     <form action="{{route('delete')}}" method="POST">
                                        <a href="{{route('show', $link->id)}}" class="btn btn-outline-primary"><i class="bi bi-info-lg"></i></a>
                                        <a href="{{$link->destination}}" target="_new"  class="btn btn-outline-primary"><i class="bi bi-link"></i></a> 
                                        <input type="hidden" name="id" value="{{$link->id}}" /> @csrf
                                            <button  class="btn btn-outline-danger" type="submit"><i class="bi bi-trash3"></i></button>
                                        </form>
                                    </td>
                                  </tr>                              
                                @endforeach
                            </tbody>
                        </table>
                    @endisset

                    @isset($edit)
                    <div class="mb-3">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            <i class="bi bi-eye"></i> Visualizações: {{$view}} 
                        </h2>
                     
                    </div>

                    <form method="POST" action="{{route('edit')}}">
                        @csrf
                        <input type="hidden" value="{{$edit->id}}" name="id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titulo</label>
                            <input type="text" value="{{$edit->title}}" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            {{route('redirect')}}/
                            <input type="text"  id="inputlink" name="link" value="{{$edit->link}}">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">URL (Não pode ser alterado)</label>
                            <input type="URL" class="form-control" name="destination" value="{{$edit->destination}}" disabled>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Atualizar</button>
                    </form>
                    @endisset
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
