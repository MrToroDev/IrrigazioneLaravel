@extends("user.dashboard")
@use(App\Models\Sensore)

@section("header")



@endsection

@section("content")
   


<div class="container mt-4">
    <h2 class="mb-3">Sensors</h2><br>
    <div>
        <button class="btn stem-btn" onclick="window.location.href = '{{ route('dashboard.sensori.create') }}'">Add new</button>
    </div>
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>*</th>
                <th>Name</th>
                <th>Type</th>
                <th>Position</th>
                <th>Garden</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($sensori as $sensore)

                <tr>
                    <td>
                        <a href="{{ route("dashboard.sensori.id", $sensore) }}">Show</a>
                    </td>
                    <td>{{ $sensore->getNome() }}</td>
                    <td>{{ $sensore->getTipo() }}</td>
                    <td>{{ $sensore->getPosizione() }}</td>
                    <td>
                        @if ($sensore->orto()->get()->first()->deleted == 1)
                        without a garden!
                        @else
                        <a href="{{ route("dashboard.orto.id", $sensore->orto()->get()->first()) }}">{{ $sensore->orto()->get()->first()->getNome() }}</a>
                        @endif
                    </td>
                </tr>
            
            @endforeach
        </tbody>
    </table>
</div>

@endsection