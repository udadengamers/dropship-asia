<form action="{{ route('administrator.logs.download', $log) }}" method="post">
    @csrf
    <button class="btn btn-primary" type="submit">Download</button>
</form>