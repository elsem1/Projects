<h2>
    New job listing for {{ $job->title }}
</h2>
<p>
    Congrats! You succesfully posted your new job on our website!
</p>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">Click here to view your new job listing</a>
</p>

