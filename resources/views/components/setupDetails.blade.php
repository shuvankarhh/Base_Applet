
    <li class="nav-item">
        @if(!empty($viewData['client']))
            <a class="nav-link" href="{{ route('set-client.create') }}">{!! $client->company->Company_Name !!}</a>
        @else
            <a class="nav-link" href="{{ route('set-client.create') }}">Set Client</a>
        @endif
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">&nbsp;|&nbsp;</a>
    </li>

    <li class="nav-item">
        @if(!empty($viewData['project']))
        <a class="nav-link" href="{{ route('set-project.create') }}">{!! $project->Project_Name !!}</a>
        @else
            <a class="nav-link" href="{{ route('set-project.create') }}">Set Project</a>
        @endif
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">&nbsp;|&nbsp;</a>
    </li>

    @if(!empty($viewData['fileUpload']))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('action') }}">Default action</a>
    </li>
    @endif

