@if(session()->has('my_message'))
 <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Estatus</h4>
        {{ session()->get('my_message') }}
 </div>
@endif