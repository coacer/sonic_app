@extends('layouts.app')

@section('title', '確認画面')
@section('content')

  <ul class="md-step">
    <li class="md-step1">入力</li>
    <li class="md-step2 is-current">確認</li>
    <li class="md-step3">完了</li>
    <!-- /.md-step --></ul>
<h1>確認画面</h1>

<div class="container" style="padding: 80px;">
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
        <td>
          @foreach ($skills as $skill)
          {{ $skill }}/
          @endforeach
        </td>
      </tr>
    </tbody>
  </table>
</div>
  <form action="{{ route('recruits.store') }}" method="post">
    @csrf
    <input type="hidden" name="name" value="{{ $recruit->name }}">
    <input type="hidden" name="name_kana" value="{{ $recruit->name_kana }}">
    <input type="hidden" name="birthday" value="{{ $recruit->birthday }}">
    <input type="hidden" name="gender" value="{{ $recruit->gender }}">
    <input type="hidden" name="email" value="{{ $recruit->email }}">
    <input type="hidden" name="phone" value="{{ $recruit->phone }}">
    <input type="hidden" name="is_experienced" value="{{ $recruit->is_experienced ? '1' : '0' }}">
    {{ $recruit->is_experienced }}
    @foreach($skills as $skill)
      <input type="hidden" name="skills[]" value="{{ $skill }}">
    @endforeach
  <p class="md-btn-wrap">
  <input type="submit" value="送信" class="md-btn md-btn-submit">
  </p>
  </form>





@endsection

