<form id="contact-form" action="{{ $path }}" method="post" class="l-form">
  @csrf
  @method($method)

  <dl class="l-form-list">
    <dt class="l-form-list-ttl">お名前<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <p><input type="text" class="md-input" name="name" value="{{ old('name') ?? $recruit->name }}"></p>
    <p class="l-form-list-notes">例）大塚　祐己</p>
    @component('components.error_field', ['errors' => $errors, 'column' => 'name'])
    @endcomponent
    </dd>
  </dl>
  <dl class="l-form-list">
    <dt class="l-form-list-ttl">フリガナ<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <p><input type="text" class="md-input" name="name_kana" value="{{ old('name_kana') ?? $recruit->name_kana }}"></p>
    <p class="l-form-list-notes">例）オオツカ　ユウキ</p>
    @component('components.error_field', ['errors' => $errors, 'column' => 'name_kana'])
    @endcomponent
    </dd>
  </dl>
  <dl class="l-form-list">
    <dt class="l-form-list-ttl">生年月日<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <p><input type="text" class="md-input" name="birthday" value="{{ old('birthday') ?? $recruit->birthday }}"></p>
    <p class="l-form-list-notes">例）1998/01/01</p>
    @component('components.error_field', ['errors' => $errors, 'column' => 'birthday'])
    @endcomponent
    </dd>
  </dl>
  <dl class="l-form-list" id="customer">
    <dt class="l-form-list-ttl">性別<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <ul class="md-formitem-list">
      <li><span class="md-radio"><input type="radio" name="gender" id="customer1" value="0" {{ old('gender') == 0 ? 'checked' : '' }}><label for="customer1">男性</label></span></li>
      <li><span class="md-radio"><input type="radio" name="gender" id="customer2" value="1" {{ old('gender') == 1 ? 'checked' : '' }}><label for="customer2">女性</label></span></li>
      <li><span class="md-radio"><input type="radio" name="gender" id="customer3" value="2" {{ old('gender') == 2 ? 'checked' : '' }}><label for="customer3">その他</label></span></li>
    </ul>
    @component('components.error_field', ['errors' => $errors, 'column' => 'gender'])
    @endcomponent
    </dd>
  </dl>
  <dl class="l-form-list">
    <dt class="l-form-list-ttl">メールアドレス<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <p><input type="text" class="md-input" name="email" value="{{ old('email') ?? $recruit->email }}"></p>
    <p class="l-form-list-notes">例）example@sonicmoov.com</p>
    @component('components.error_field', ['errors' => $errors, 'column' => 'email'])
    @endcomponent
    </dd>
  </dl>

  <dl class="l-form-list">
    <dt class="l-form-list-ttl">電話番号<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <p><input type="text" class="md-input" name="phone" value="{{ old('phone') ?? $recruit->phone }}"></p>
    <p class="l-form-list-notes">例）03-5206-7886</p>
    @component('components.error_field', ['errors' => $errors, 'column' => 'phone'])
    @endcomponent
    </dd>
  </dl>

  <dl class="l-form-list" id="customer">
    <dt class="l-form-list-ttl">プログラミング経験<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <ul class="md-formitem-list">
      <li><span class="md-radio"><input type="radio" name="is_experienced" id="true" value="1" {{ old('is_experienced') == 1 ? 'checked' : '' }}><label for="true">有り</label></span></li>
      <li><span class="md-radio"><input type="radio" name="is_experienced" id="false" value="0" {{ old('is_experienced') == 0 ? 'checked' : '' }}><label for="false">無し</label></span></li>
    </ul>
    @component('components.error_field', ['errors' => $errors, 'column' => 'is_experienced'])
    @endcomponent
    </dd>
  </dl>

  <dl class="l-form-list" id="customer">
    <dt class="l-form-list-ttl">今まで学んだ技術<span class="l-form-list-required">[必須]</span></dt>
    <dd class="l-form-list-data">
    <ul class="md-formitem-list">
      @foreach ($skills as $skill)
        <li>
          <span class="md-radio">
            <input
              type="checkbox"
              name="skills[]"
              id="{{ $skill }}"
              value="{{ $skill }}"
              @if (!empty($recruit->recruitSkills) && in_array($skill, $recruit->recruitSkills->pluck('skill_type')->toArray(), true)) checked @endif
            >
            <label for="{{ $skill }}">{{ $skill }}</label>
          </span>
        </li>
      @endforeach
    </ul>
    </dd>
  </dl>

  {{ $slot }}

  <p class="md-btn-wrap">
  <input type="submit" value="{{ $method === 'post' ? '確認画面へ' : '保存' }}" class="md-btn md-btn-submit">
  </p>
  <input type="hidden" name="form[mode]" value="confirm" />
  <input type="hidden" name="form[__csrf]" value="2c520919fe55e9352f07bfd2fda83fe1" />
  <!-- /.l-form" --></form>

