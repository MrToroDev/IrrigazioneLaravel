@extends("user.dashboard")
@use(App\Models\Sensore)

@section("header")



@endsection

@section("content")
   


<div class="container mt-4">
    <h2 class="mb-3">Sensors</h2>
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
                        <a href="{{ route("dashboard.orto.id", $sensore->orto()->get()->first()) }}">{{ $sensore->orto()->get()->first()->getNome() }}</a>
                    </td>
                </tr>
            
            @endforeach
        </tbody>
    </table>
</div>

@endsection