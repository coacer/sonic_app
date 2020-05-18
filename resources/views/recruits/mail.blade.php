{{ $recruit->name }} ({{ $recruit->name_kana }}) 様から採用応募を頂きました。<br>
対応お願いします。<br>

詳細: {{ url(route('recruits.show', $recruit)) }}<br>
メールアドレス: {{ $recruit->email }}
