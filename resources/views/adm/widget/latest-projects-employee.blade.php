
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
                      <th>ટાસ્કનું નામ</th>
                      <th>વિગત</th>         
                      <th>કામગીરી વ્યક્તિ</th>
                      <th>કચેરીનું નામ</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($pendingTaskLists as $key => $pendingTaskList)
                    
                    <tr>
                      <td>{{++$key}}</td>
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

                      <td>{{getTaskData($pendingTaskList->task_id)->name}}</td>
                      <td>{{$pendingTaskList->description}}</td>

                      <td>

                  @foreach(getEmployees($pendingTaskList->admin_group) as $key => $admin_group)
                  <a href="{{route('task-assign.show',$pendingTaskList->task_assign_id)}}?employee={{getEmployee($admin_group->id)->id}}">

                  <div class="d-flex flex-row">

                        @if(isset($admin_group->image))
                                
                          <p class="pull-left mr-2 text-strong text-danger">
                              <img class="img-circle elevation-2 object-fit"  height="40" width="40"
                            src="{{asset('web')}}/media/icon/{{getEmployee($admin_group->id)->image}}">
                            
                              <strong class="pl-1">({{++$key}}) 
                              <span class="">{{$admin_group->name}}</span></strong></p>
                            </a>

                          @else
                                <p class="pull-left mr-2 text-strong text-danger">
                            <img class="img-circle elevation-2"   height="40" width="40"
                              src="{{asset('adm')}}/img/no-user.jpeg">
                                <strong class="pl-1">({{++$key}})
                                <span>{{$admin_group->name}}</span> </strong></p>
                        @endif
                      </div>
                    </a>
                  @endforeach
                  </td>



                      <td class="">
                        @if(getParents($pendingTaskList->category_id)['category'])
                          <span class='badge badge-primary p-1'>{{getParents($pendingTaskList->category_id)['category']->name}}</span>
                        @endif

                        @if(getParents($pendingTaskList->category_id)['subcategory'])
                          <span class='badge badge-danger p-1'>{{getParents($pendingTaskList->category_id)['subcategory']->name}}</span>
                        @endif
                        
                        @if(getParents($pendingTaskList->category_id)['subcategory2'])
                          <span class='badge badge-warning p-1'>{{getParents($pendingTaskList->category_id)['subcategory2']->name}}</span>
                        @endif
                        </td>
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