<h1>Laravel ile E-Ticaret Projesi</h1>
<p>Merhaba {{ $user->adsoyad }}, kaydınız başarılı bir şekilde yapıldı.</p>

<p>Kaydınızı aktifleştirmek için <a href="{{ config('app.url') }}/kullanici/aktiflestir/{{ $user->aktivasyon_anahtari }}">tıklayın</a> veya aşağıdaki bağlantıyı tarayıcınızda açın.</p>

<p>{{ config('app.url') }}/kullanici/aktiflestir/{{ $user->aktivasyon_anahtari }}</p>