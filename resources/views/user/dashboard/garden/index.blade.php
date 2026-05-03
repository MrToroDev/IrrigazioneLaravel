@extends("user.dashboard")
@use(App\Models\Orto)

@section("header")


@endsection

@section("content")


<div class="container mt-4">
    <h2 class="mb-3">Gardens - {{ $orto->getNome() }}</h2>
    
    
</div>

@endsection