@extends("user.dashboard")
@use(App\Models\Orto)
@use(App\Models\Sensore)

@section("header")


@endsection

@section("content")


<div class="container mt-4">
    <h2 class="mb-3">Sensor <strong>{{ $sensore->getNome() }}</strong> of <strong><a class="stem-tx-color" href="{{ route('dashboard.orto.id', $sensore->orto()->get()->first()) }}">{{ $sensore->orto()->get()->first()->getNome() }}</a></strong></h2>
    
    <br>

    <div class="container">
        <h3><strong>Position (Latitude/Longitude):</strong> {{ $sensore->getPosizione() }}</h3>
        <h3><strong>Type of sensor:</strong> {{ $sensore->getTipo() }}</h3>
    </div>
    <br>
    <div class="container">
        <h2 class="mb-3">Measurements</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Value</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($sensore->misurazioni()->get()->all() as $misurazione)

                    <tr>
                        <td>{{ $misurazione->getValore() }}</td>
                        <td>{{ $misurazione->getDataOra() }}</td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection