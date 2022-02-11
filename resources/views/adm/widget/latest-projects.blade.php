
            <div class="card">
              <div class="card-header border-transparent bg-dark">
                <h3 class="card-title text-strong">પેન્ડિંગ કામકાજ</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>અરજદાર</th>
                      <th>ફોટો</th>                      
                      <th>ટાસ્કનું નામ</th>
                      <th>વિગત</th>
                      <th>કામગીરી વ્યક્તિ</th>
                     
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($pendingTaskLists as $key => $pendingTaskList)
                    <tr>
                      <td>
                          <a href="{{route('client.edit',getClient($pendingTaskList->task_id)->id)}}">
                            @if(isset(getClient($pendingTaskList->task_id)->image))
                              <img class="img-circle elevation-2 object-fit"  height="40" width="40"
                                    src="{{asset('web')}}/media/icon/{{getClient($pendingTaskList->task_id)->image}}">
                              @else
                              <img class="img-circle elevation-2"  height="40" width="40"
                                  src="{{asset('adm')}}/img/no-user.jpeg">
                              @endif
                                    <strong class="pl-1">
                              <span class="">{{getClient($pendingTaskList->task_id)->name}}</span></span></strong>
                            </a>
                            
                            </td>

                      <td>{{$key}}</td>

                      @if($pendingTaskList->client_image)
                        <td><img class="img-circle elevation-2"  width="60"  height="60"
                            src="{{asset('web')}}/media/lg/{{$pendingTaskList->client_image}}"></td>
                            @else
                            
                        <td><img class="img-circle elevation-2" 
                            src="{{asset('adm')}}/img/no-user.jpeg" width="60"></td>
                        @endif

                      <td>{{$pendingTaskList->task_name}}</td>
                      <td>{{$pendingTaskList->task_description}}</td>
                      <td>{{$pendingTaskList->admin_name}}</td>
                      <td> 
                       
                      @if(session('LoggedUser')->id == 1)
                        <a href="{{route('task-assign.show',$pendingTaskList->task_assign_id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                      @else
                        <a href="{{route('admin.task.assign.show.employee',$pendingTaskList->task_assign_id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                      @endif

                      </td>
                    </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card-footer clearfix">
                <a href="{{route('task-assign.index')}}" class="btn btn-sm btn-secondary float-right">View All Tasks</a>
              </div>
            </div>