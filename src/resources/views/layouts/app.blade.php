<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>form-craft</title>
  @vite(['resources/css/sanitize.css', 'resources/css/common.css'])
  @yield('css')
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">form-craft</a>
      @yield('header-nav')
    </div>
  </header>

  <main>
    @yield('content')
  </main>
  @yield('js')
</body>
</html>
