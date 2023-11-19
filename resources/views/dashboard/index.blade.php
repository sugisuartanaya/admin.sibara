<h1>Welcome {{ auth()->user()->username }}</h1>

<form action="/logout" method="post">
  @csrf
  <button type="submit">logout</button>
</form>
