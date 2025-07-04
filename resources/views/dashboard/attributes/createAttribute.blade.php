<!-- Modal -->
<div class="modal fade" id="attributeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_attribute') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validation --}}
                {{-- @if ($errors->any()) --}}
                <div class="alert alert-danger" id="error_div" style="display: none">
                    <ul id="error_list">
                        {{-- @foreach ($errors->all() as $error) --}}
                            {{-- <li class="text-danger"> {{$error}}</li> --}}
                        {{-- @endforeach --}}
                    </ul>
                </div>
                {{-- @endif --}}

                <form action="" id="createAttribute" class="form" method="POST" >
                    @csrf 

                    <div class="form-group">
                        <label for="name">{{ __('dashboard.attribute_name_ar') }}</label>
                        <input type="text" name="name[ar]" class="form-control" id="name"
                            placeholder="{{ __('dashboard.attribute_name_ar') }}"> 
                            <strong class="text-danger" id="errors_attribute_name_ar"></strong> 

                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('dashboard.attribute_name_en') }}</label>
                        <input type="text" name="name[en]" class="form-control" id="name"
                            placeholder="{{ __('dashboard.attribute_name_en') }}">
                            <strong class="text-danger" id="errors_attribute_name_en"></strong> 

                    </div>
                    <hr>

                    <div class="row attribute_values_row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">{{ __('dashboard.attribute_value_ar') }}</label>
                                <input type="text" name="value[1][ar]" class="form-control" id="value_ar_1"
                                    placeholder="{{ __('dashboard.attribute_value_ar') }}">
                                    <strong class="text-danger" id="errors_attribute_value_ar"></strong>

                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">{{ __('dashboard.attribute_values_en') }}</label>
                                <input type="text" name="value[1][en]" class="form-control" id="value_en_1"
                                    placeholder="{{ __('dashboard.attribute_values_en') }}">
                                    <strong class="text-danger" id="errors_attribute_value_en"></strong>

                            </div>
                        </div>
                        
                        <div class="col-md-2 mt-2">
                            <button disabled type="button" class="btn btn-danger remove"><i class="ft-x"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" id="add_more"><i class="ft-plus"></i></button>
                        </div>
                    </div><br>

                

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><i class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary">  <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>