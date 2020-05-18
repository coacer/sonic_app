@extends('layouts.app')

@section('title', '応募フォーム')
@section('content')

  <ul class="md-step">
    <li class="md-step1 is-current">入力</li>
    <li class="md-step2">確認</li>
    <li class="md-step3">完了</li>
    <!-- /.md-step --></ul>

  <h1>エントリーフォーム</h1>

  @component('components.form', [
    'path' => route('recruits.confirm'),
    'method' => 'post',
    'skills' => $skills,
    'recruit' => $recruit
    ])
    <div class="md-txt-agree">
      <span class="md-checkbox md-checkbox-lg">
        <input type="checkbox" name="agree" id="agree" value="on" ><label for="agree"><a href="#" target="_blank">個人情報</a>の取り扱いに同意する</label>
      </span>
      <label class="error" for="agree" generated="true"></label>
      <p class="l-form-list-error"></p>
    </div>
  @endcomponent





@endsection
