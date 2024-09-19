<x-layout>
    <x-bread-crumbs :links="['My Jobs' => '#' ]"/>
    

     <div class="mb-8 text-right">
        <x-link-button href="{{route('my-jobs.create')}}">Add New</x-link-button>
    </div>   

    @forelse ($jobs as $job)
        <x-job-card :$job>
            <div class="text-xs text-slate-500">
                @if (!$job->deleted_at)
                @forelse ($job->jobApplications as $application)
                <div class="mb-4 flex items-center justify-between ">
                    <div>
                        <div>{{$application->user->name}}</div>
                        <div>
                            Applied {{$application->created_at->diffForHumans()}}
                        </div>
                        <div>Download CV</div>
                    </div>
                    <div>${{number_format($application->expected_salary)}}</div>
                </div>
            @empty
                <div>No Applications yet</div>
            @endforelse
                @else
                    @forelse ($job->jobApplications as $application)
                    <div class="mb-4 flex items-center justify-between ">
                        <div>
                            <div><del>{{$application->user->name}}</del></div>
                            <div>
                                <del>Applied {{$application->created_at->diffForHumans()}}</del>
                            </div>
                            <div><del>Download CV</del></div>
                        </div>
                        <div><del>${{number_format($application->expected_salary)}}</del></div>
                    </div>
                @empty
                    <div><del>No Applications yet</del></div>
                @endforelse
                @endif
                

                <div class="flex space-x-2 mt-2">
                    @if (!$job->deleted_at)
                    <x-link-button href="{{route('my-jobs.edit',$job)}}">Edit</x-link-button>

                    <form action="{{route('my-jobs.destroy',$job)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Delete</x-button>
                    </form>
                    @else
                    <x-link-button href="#"><del>Edit</del></x-link-button>

                    <form action="#" method="POST">
                        @csrf
                        <x-button><del>Delete</del></x-button>
                    </form>
                    @endif
                    
                    
                </div>
            </div>
        </x-job-card>
    @empty
    <div class="rounded-md border border-dashed border-slate-300 p-8">
        <div class="text-center font-medium">
            No jobs yet
        </div>
    <div class="text-center">
        Go create some jobs <a href="{{route('my-jobs.create')}}" class="text-indigo-500 hover:undeline">here!</a>
    </div>
</div>
    @endforelse
</x-layout>