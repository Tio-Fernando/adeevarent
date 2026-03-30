
<div class="max-w-3xl mx-auto px-6 py-10">

  <div class="bg-white rounded-2xl shadow p-6">

    <h2 class="text-xl font-bold mb-4">Profile User</h2>

    <div class="space-y-2 text-sm">
      <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
      <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-6">
      @csrf
      <button type="submit"
        class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg text-sm font-semibold transition">
        Logout
      </button>
    </form>

  </div>

</div>
