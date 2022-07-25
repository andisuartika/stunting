@extends('../layouts/side-menu')

@section('subhead')
    <title>Stunting - Data Balita</title>
@endsection

@section('data-balita', 'side-menu--active')
@section('title', 'Data Balita')

@section('subcontent')
    @livewire('data-balita')
@endsection

