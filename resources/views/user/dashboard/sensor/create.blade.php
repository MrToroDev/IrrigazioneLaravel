@extends("user.dashboard")
@use(App\Models\Sensore)

@section("header")

@endsection

@section("content")

<div class="container mt-4">
    <h2 class="mb-3">Gardens - Add new</h2>
    <br>
    
    <form action="{{ route('dashboard.sensori.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Name</label>
            <input type="text" class="form-control" id="nome" name="Nome" placeholder="Insert the name of your garden" required>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="Latitudine" placeholder="The latitude position" required>
        </div>
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="Longitudine" placeholder="The longitude position" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Type</label>
            <select class="form-select" id="tipo" name="TipoSensore" required>
                @foreach (App\Models\Enums\TipoSensore::cases() as $tipo)
                    <option value="{{ $tipo->value }}">{{ $tipo->value }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="orto" class="form-label">Garden</label>
            <select class="form-select" id="orto" name="IdOrto" required>
                @foreach (Auth::user()->orti()->get()->all() as $orto)
                @if ($orto->deleted == 1) @continue;
                @endif

                    <option value="{{ $orto->IdOrto }}">{{ $orto->getNome() }}</option>
                @endforeach
            </select>
        </div>
        
        <!-- Pulsante di invio -->
        <button type="button" class="btn stem-btn" onclick="window.location.href = '{{ route('dashboard.sensori') }}'">Back</button>
        <button type="submit" class="btn stem-btn">Add</button>
    </form>

</div>

@endsection