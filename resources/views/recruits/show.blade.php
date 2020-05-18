@extends('layouts.app')

@section('title', '応募詳細')

@section('content')
  <h1>応募詳細</h1>

  <table class="table table-striped">
    <tbody>
      <tr>
        <th scope="col">お名前</th>
        <td>{{ $recruit->name }}</td>
      </tr>
      <tr>
        <th scope="col">フリガナ</th>
        <td>{{ $recruit->name_kana }}</td>
      </tr>
      <tr>
        <th scope="col">生年月日</th>
        <td>{{ $recruit->birthday }}</td>
      </tr>
      <tr>
        <th scope="col">性別</th>
        <td>{{ $recruit->getGender() }}</td>
      </tr>
      <tr>
        <th scope="col">メールアドレス</th>
        <td>{{ $recruit->email }}</td>
      </tr>
      <tr>
        <th scope="col">電話番号</th>
        <td>{{ $recruit->phone }}</td>
      </tr>
      <tr>
        <th scope="col">プログラミング経験</th>
        <td>{{ $recruit->getIsExperienced() }}</td>
      </tr>
      <tr>
        <th scope="col">今まで学んだ技術</th>
        <td>{{ $recruit->displaySkills() }}</td>
      </tr>
      <tr>
        <th scope="col">対応</th>
        <td>{{ $recruit->getIsCompleted() }}</td>
      </tr>
    </tbody>
  </table>
  <a href="{{ route('recruits.edit', $recruit) }}" class="btn btn-info btn-lg">編集</a>
  <form action="{{ route('recruits.destroy', $recruit->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-lg">削除</button>
  </form>
  <a style="color: blue; text-decoration: underline;" href="{{ route('recruits.index') }}">戻る</a>
@endsection

