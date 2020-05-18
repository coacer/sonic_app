@extends('layouts.app')

@section('title', '応募一覧')

@section('content')
  <h1>応募一覧</h1>

  <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">お名前</th>
          <th scope="col">フリガナ</th>
          <th scope="col">性別</th>
          <th scope="col">メールアドレス</th>
          <th scope="col">対応</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($recruits as $recruit)
          <tr>
            <td>
              <a href="{{ route('recruits.show', $recruit->id) }}">
                {{ $recruit->name }}
              </a>
            </td>
            <td>{{ $recruit->name_kana }}</td>
            <td>{{ $recruit->getGender() }}</td>
            <td>{{ $recruit->email }}</td>
            <td>{{ $recruit->getIsCompleted() }}</td>
            <td>
              <a href="{{ route('recruits.edit', $recruit) }}" class="btn btn-info">編集</a>
            </td>
            <td>
              <form action="{{ route('recruits.is_completed', $recruit) }}" method="post">
                @csrf
                @method('put')
                <button class="btn {{ $recruit->is_completed ? 'btn-secondary' : 'btn-success' }}" {{ $recruit->is_completed ? 'disabled' : '' }}>対応完了</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
