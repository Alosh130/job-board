<x-card class="mb-4">
        <div class="mb-4 flex justify-between">
            @if (!$job->deleted_at)
            <h2 class="text-lg font-medium">{{$job->title}}</h2>
            <div class="text-slate-500">${{number_format($job->salary)}}</div>
            @else
            <h2 class="text-lg font-medium"><del>{{$job->title}}</del></h2>
            <div class="text-slate-500"><del>${{number_format($job->salary)}}</del></div>
            @endif
            
        </div>

        <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
            <div class="flex items-center space-x-4">
                @if (!$job->deleted_at)
                <div>{{$job->employer->company_name}}</div>
                <div>{{$job->location}}</div>
                @else
                <div><del>{{$job->employer->company_name}}</del></div>
                <div><del>{{$job->location}}</del></div>
                @endif
                
                @if ($job->deleted_at)
                    <span class="text-xs text-red-500">Deleted</span>
                @endif
            </div>
            <div class="flex space-x-1 text-xs">
                @if (!$job->deleted_at)
                <x-tag>
                    <a href="{{route('jobs.index',['experience' => $job->experience])}}">
                        {{Str::ucfirst($job->experience)}}
                    </a>
                </x-tag>

                <x-tag>
                    <a href="{{route('jobs.index', ['category' => $job->category])}}">
                        {{$job->category}}
                    </a>
                    
                </x-tag>
                @else
                <x-tag>
                    <a href="{{route('jobs.index',['experience' => $job->experience])}}">
                        <del>{{Str::ucfirst($job->experience)}}</del>
                    </a>
                </x-tag>

                <x-tag>
                    <a href="{{route('jobs.index', ['category' => $job->category])}}">
                        <del>{{$job->category}}</del>
                    </a>
                    
                </x-tag>
                @endif
                
            </div>
        </div>

        
        {{$slot}}

        </x-card>