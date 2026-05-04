@extends("user.dashboard")
@use(App\Models\Orto)

@section("header")

@endsection

@section("content")

<div class="container mt-4">
    <h2 class="mb-3">Gardens</h2>
    <br>
    <div>
        <button class="btn stem-btn" onclick="window.location.href = '{{ route('dashboard.orto.create') }}'">Add new</button>
    </div>
    <br>

    @if (count($orti) == 0)

    <div class="text-center">
        <i class="bi bi-arrow-left-circle" style="font-size: 3rem; color: #dee2e6;"></i>
        <p class="text-muted">
            Looks a bit empty here... Start by adding a new garden!
        </p>
    </div>

    @else

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
            @foreach ($orti as $orto)

                <tr>
                    <td>
                        <a href="{{ route("dashboard.orto.id", $orto) }}">Show</a>
                    </td>
                    <td>{{ $orto->getNome() }}</td>
                    <td>{{ $orto->getTipo() }}</td>
                    <td>{{ $orto->getPosizione() }}</td>
                </tr>
            
            @endforeach
        </tbody>
    </table>

    @endif
</div>

@endsection