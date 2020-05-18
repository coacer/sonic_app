@extends('layouts.app')

@section('title', '応募編集フォーム')
@section('content')

  <h1>応募編集フォーム</h1>

  @component('components.form', [
    'path' => route('recruits.update', $recruit),
    'method' => 'patch',
    'skills' => $skills,
    'recruit' => $recruit
    ])
  @endcomponent

@endsection
