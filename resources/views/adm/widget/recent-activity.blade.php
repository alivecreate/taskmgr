
            <div class="card">
              <div class="card-header border-transparent bg-info">
                <h3 class="card-title text-strong">હાલની પ્રક્રિયા</h3>

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
                      <th>કામગીરી વ્યક્તિ</th>
                      <th>પ્રકાર</th>
                      <th>વિગત</th>
                     
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($recentActivityLists as $key => $recentActivityList)
                    <tr>
                      <td>{{$recentActivityList->admin_name}}</td>
                      
                      
                      <td>@if($recentActivityList->type == 'status')Status Changed @endif</td>
                      <td><span class="{{getStatusBadgeColor($recentActivityList->status_name)}}">{{$recentActivityList->status_name}}</span></td>
                      <td>  
                      <a href="{{route('task-assign.show',$recentActivityList->task_assign_id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                        
                      </td>
                    </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>