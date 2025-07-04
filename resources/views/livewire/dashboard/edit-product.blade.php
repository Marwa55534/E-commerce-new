<section id="icon-tabs">
    @if (!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    @if (!empty($errorMessage))
        <div class="alert alert-danger">
            {{ $errorMessage }}
        </div>
    @endif


    <ul class="wizard-timeline center-align">
        <li class="{{ $currentStep > 1 ? 'completed' : '' }}">
            <span class="step-num">1</span>
            <label>{{ __('dashboard.basic_information') }}</label>
        </li>
        <li class="{{ $currentStep > 2 ? 'completed' : '' }}">
            <span class="step-num">2</span>
            <label>{{ __('dashboard.product_variants') }}</label>
        </li>
        <li class="active {{ $currentStep > 3 ? 'completed' : '' }}">
            <span class="step-num">3</span>
            <label>{{ __('dashboard.product_images') }}</label>
        </li>
        {{-- <li class="{{ $currentStep == 4 ? 'completed' : '' }}">
            <span class="step-num">4</span>
            <label>{{ __('dashboard.confirmation') }}</label>
        </li> --}}
    </ul>

    <form class="wizard-circle">

        {{-- first step Product Basic Info --}}
        <div class="setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
            <h3> Step 1</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstName2"> {{ __('dashboard.product_name_ar') }} :</label>
                        <input wire:model="name_ar" type="text" class="form-control" id="firstName2"
                            placeholder="{{ __('dashboard.product_name_ar') }}">
                        @error('name_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstName2"> {{ __('dashboard.product_name_en') }} :</label>
                        <input wire:model="name_en" type="text" class="form-control" id="firstName2"
                            placeholder="{{ __('dashboard.product_name_en') }}">
                        @error('name_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress3"> {{ __('dashboard.small_description_ar') }}
                            :</label>
                        <textarea wire:model="small_desc_ar" class="form-control" id="emailAddress3"></textarea>
                        @error('small_desc_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress3"> {{ __('dashboard.small_description_en') }}
                            :</label>
                        <textarea wire:model="small_desc_en" class="form-control" id="emailAddress3"></textarea>
                        @error('small_desc_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location2"> {{ __('dashboard.description_ar') }} :</label>
                        <textarea wire:model="desc_ar" class="form-control" id="emailAddress3"></textarea>
                        @error('desc_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location2"> {{ __('dashboard.description_en') }} :</label>
                        <textarea wire:model="desc_en" class="form-control" id="emailAddress3"></textarea>
                        @error('desc_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category"> {{ __('dashboard.category') }} :</label>
                        <select wire:model="category_id" class="form-control custom-select" id="category">
                            <option value=""> {{ __('dashboard.select_category') }} </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="brand"> {{ __('dashboard.brand') }} :</label>
                        <select wire:model="brand_id" class="form-control custom-select" id="brand">
                            <option value=""> {{ __('dashboard.select_brand') }} </option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lastName2"> {{ __('dashboard.product_sku') }} :</label>
                        <input wire:model="sku" type="text" class="form-control" id="lastName2">
                        @error('sku')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date"> {{ __('dashboard.available_for') }} :</label>
                        <input wire:model="available_for" type="date" class="form-control" id="date">
                        @error('available_for')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
               

            </div>
            <button class="btn btn-primary pull-right mb-3" wire:click="firstStepSubmit"
                type="button">{{ __('dashboard.next') }}</button>
        </div>

        {{-- second step Product Variants? --}}
        <div class="setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="has_variants"> {{ __('dashboard.has_variants') }} :</label>
                        <select name="has_variants" id="has_variants" wire:model.live="has_variants"
                            class="form-control">
                            <option value="0" selected>{{ __('dashboard.no') }}</option>
                            <option value="1">{{ __('dashboard.yes') }}</option>
                        </select>
                        @error('has_variants')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if ($has_variants == 0)
                <div class="col-6">
                    <div class="form-group">
                        <label for="price">{{ __('dashboard.price') }} :</label>
                        <input type="number" class="form-control" name="price" id="price"
                            wire:model.live="price" placeholder="{{ __('dashboard.price') }}">
                        {{-- @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                </div>
                @endif
                
                @if ($has_variants==0)
                <div class="col-6">
                    <div class="form-group">
                        <label for="quantity">{{ __('dashboard.manage_stock') }} :</label>
                        <select name="manage_stock" id="status" class="form-control"
                            wire:model.live="manage_stock">
                            <option value="0" selected>{{ __('dashboard.no') }}</option>
                            <option value="1">{{ __('dashboard.yes') }}</option>
                        </select>
                        {{-- @error('manage_stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                </div> 
                {{-- depend on Manage stock --}}
                @if ($manage_stock == 1)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">{{ __('dashboard.quantity') }} :</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                wire:model.live="quantity" placeholder="{{ __('dashboard.quantity') }}">
                            {{-- @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                    </div>
                @endif
                @endif 

                @if ( $has_variants == 0)
                 <div class="col-6">
                    <div class="form-group">
                        <label for="status">{{ __('dashboard.has_discount') }} :</label>
                        <select name="status" id="status" class="form-control" wire:model.live="has_discount">
                            <option value="0" selected>{{ __('dashboard.no_discount') }}</option>
                            <option value="1">{{ __('dashboard.has_discount') }}</option>
                        </select>
                        {{-- @error('has_discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                </div> 
                @endif

                {{-- depend on has discount --}}
                {{-- @if ($has_discount == 1) --}}
                @if ($has_discount == 1 && $has_variants == 0)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="discount">{{ __('dashboard.discount') }}</label>
                            <input class="form-control" type="number" wire:model.live="discount"
                                placeholder="{{ __('dashboard.discount') }}">
                            {{-- @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="start_discount">{{ __('dashboard.start_discount') }}</label>
                            <input type="date" wire:model.live="start_discount" class="form-control"
                                placeholder="{{ __('dashboard.start_discount') }}">
                            {{-- @error('start_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="end_discount">{{ __('dashboard.end_discount') }}</label>
                            <input type="date" wire:model.live="end_discount" class="form-control"
                                placeholder="{{ __('dashboard.end_discount') }}">
                            {{-- @error('end_discount')
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror --}}
                        </div>
                    </div>
                @endif
            </div>  

            {{-- variants --}}
            @if ($has_variants == 1)
                <hr class="bg-black">
                @for ($i = 0; $i < $valueRowCount; $i++)
                    <div class="row">
                        <hr>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">{{ __('dashboard.price') }}</label>
                                <input wire:model="prices.{{ $i }}" type="number" class="form-control"
                                    placeholder="Product Price">
                                @error('prices.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">{{ __('dashboard.quantity') }}</label>
                                <input wire:model="quantities.{{ $i }}" type="number"
                                    class="form-control" placeholder="Product Quantity">
                                @error('quantities.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($productAttributes as $attr)
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="price"> {{ $attr->name }} {{ __('dashboard.product') }}</label>
                                    <select wire:model="variantAttributes.{{ $i }}.{{ $attr->id }}"
                                        class="form-control">
                                        <option value="">Select {{$attr->name}}</option> 
                                        {{-- <option value="" selected>Select</option> --}}

                                         @foreach ($attr->attributeValues as $item) 
                                            {{-- @foreach ($variantAttributes as $variantAttribute) --}}
                                                 <option value="{{ $item->id }}" @selected(($variantAttributes[$i][$attr->id] ?? null) == $item->id)>
                                                    {{ $item->value }}
                                                </option> 
                                            {{-- @endforeach --}}
                        
                                         @endforeach 
                                    </select>

                                </div>
                            </div>
                        @endforeach

                         <!-- زر الحذف -->
                        @if ($valueRowCount > 1)
                            <div class="col-3">
                                <button type="button" wire:click="removeVariant({{ $i }})" class="btn btn-danger mt-4">
                                    <i class="la la-trash"></i> {{ __('dashboard.delete') }}
                                </button>
                            </div>
                        @endif 
                    </div>
                    <hr class="bg-black">
                @endfor
                <button type="button" wire:click="addNewVariant" class="btn btn-success"><i class="la la-plus"></i>
                    {{ __('dashboard.Add_New_Variant') }}
                </button>
                    {{-- @if ($valueRowCount > 1)
                    <button type="button" wire:click="removeVariant" class="btn btn-danger"><i class="la la-minus"></i>
                        Remove Variant
                    </button>
                    @endif --}}
    
            @endif

            <button class="btn btn-primary pull-right  mb-3 ml-1" type="button"
                wire:click="secondStepSubmit">{{ __('dashboard.next') }}
            </button>
            <button class="btn btn-danger  pull-right" type="button"
                wire:click="back(1)">{{ __('dashboard.back') }}
            </button>
        </div>

        {{-- third step Product Images --}}
         <div class="setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="images"> {{ __('dashboard.product_images') }} :</label>
                        <input type="file" wire:model.live="newImages" class="form-control" multiple>
                    </div>
                </div>
                @error('images')
                    <div class="col-md-12 alert  alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                {{-- images db --}}
                 @if ($images)
                    <div class="col-md-12">
                        @foreach ($images as $key => $image)
                            <div class="position-relative d-inline-block mr-2 mb-2">
                                <img src="{{ asset('uploads/products/'.$image->file_name ) }}" class="img-thumbnail rounded-md"
                                    width="300px" height="300px">

                                @if (count($images) > 1)
                                 <!-- Delete Button -->
                                <button type="button" wire:click="deleteImage({{ $image->id }},{{$key}},'{{$image->file_name}}')"
                                    class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @else
                                    <!-- If only one image, don't display delete button -->
                                    <button type="button" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px; pointer-events: none; opacity: 0.5;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endif

                            
                            </div>
                        @endforeach
                    </div>
                @endif 

                {{-- new images uploads --}}
                @if ($newImages)
                <div class="col-md-12">
                    @foreach ($newImages as $key => $image)
                        <div class="position-relative d-inline-block mr-2 mb-2">
                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail rounded-md"
                                width="300px" height="300px">

                             <!-- Delete Button -->
                            <button type="button" wire:click="deleteNewImage({{ $key }})"
                                class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif 
            </div>

            
            <button class="btn btn-success  pull-right  mb-3 ml-1" wire:click="submitForm"
                type="button">{{ __('dashboard.next') }}!</button>
            <button class="btn btn-danger  pull-right  mb-3" type="button"
                wire:click="back(2)">{{ __('dashboard.back') }}</button>

        </div>    


    </form>
</section>

