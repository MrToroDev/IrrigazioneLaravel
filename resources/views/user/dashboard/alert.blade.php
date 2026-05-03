@extends("user.dashboard")
@use(App\Models\TipoAlert)
@use(App\Models\Alert)
@use(Carbon\Carbon;)

@section("header")
<link href="{{ asset('css/dashboard.alert.style.css') }}" rel="stylesheet">
<script src="{{ asset('js/dashboard.alert.js') }}"></script>
@endsection

@section("content")

<div class="container mt-4">
    <h2 class="mb-3">Alerts</h2>
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>*</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Seen</th>
                <th>*</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($alerts as $alert)
                @if ($alert->getTipo() == TipoAlert::WARNING)
                <tr class="table-warning">
                @elseif ($alert->getTipo() == TipoAlert::DANGER)
                <tr class="table-danger">
                @elseif ($alert->getTipo() == TipoAlert::INFO)
                <tr class="table-info">
                @endif

                    <td>
                        @if ($alert->getDataVisualizzazione() == "new")
                        <form action="{{ route('dashboard.alert.update', $alert) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit">
                                <i class="bi bi-envelope"></i>
                            </button>
                        </form>
                        @else
                        <i class="bi bi-envelope-open"></i>
                        @endif
                    </td>
                    
                    <td>{{ $alert->getTipo() }}</td>
                    <td><span class="alert_description">{{ $alert->getDescrizione() }}</span></td>
                    <td>{{ $alert->getDataOra() }}</td>
                    <td>{{ $alert->getDataVisualizzazione() }}</td>
                    <td>
                        <form action="{{ route('dashboard.alert.destroy', $alert) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection