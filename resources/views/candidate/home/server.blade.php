<div class="content-full">
    <div class="pt-4">
        @foreach ($servers as $server)
            <div>Total visits to {{$server->name}}: <strong>{{$server->count}}</strong></div>
            <div>Last visit to {{$server->name}}: <strong>{{$server->updated_at}}</strong></div>
        @endforeach
    </div>
</div>
