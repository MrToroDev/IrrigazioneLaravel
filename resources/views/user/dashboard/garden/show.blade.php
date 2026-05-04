@extends("user.dashboard")
@use(App\Models\Orto)
@use(App\Models\Sensore)
@use(App\Models\Irrigazione)

@section("header")


@endsection

@section("content")


<div class="container mt-4">
    <h2 class="mb-3">Gardens - <strong>{{ $orto->getNome() }}</strong></h2>
    <br>
    <form action="{{ route('dashboard.orto.delete', $orto) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="button" class="btn stem-btn" onclick="window.location.href = '{{ route('dashboard.orto.edit', $orto) }}'">Edit</button>

    <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <br>
    <br>
    <div class="container">
        <h3><strong>Position (Latitude/Longitude):</strong> {{ $orto->getPosizione() }}</h3>
        <h3><strong>Type of garden:</strong> {{ $orto->getTipo() }}</h3>
    </div>
    <br>
    <div class="container">
        <h2 class="mb-3">Sensors</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>*</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($orto->sensori()->get() as $sensore)
                    <tr>
                        <td>
                            <a href="{{ route("dashboard.sensori.id", $sensore) }}">Show</a>
                        </td>
                        <td>{{ $sensore->getNome() }}</td>
                        <td>{{ $sensore->getTipo() }}</td>
                        <td>{{ $sensore->getPosizione() }}</td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="container">
        <h2 class="mb-3">Irrigations</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Consumed liters</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($orto->irrigazioni()->get() as $irrigazione)
                    <tr>
                        <td>{{ $irrigazione->getLitriConsumati() }}</td>
                        <td>{{ $irrigazione->getDataOra() }}</td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection