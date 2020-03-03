
<div class="row">
    <p>امکانات ملک </p>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="new-property" class="bmd-label-static">افزودن مورد جدید  <span id="title_error" class="text-danger"></span></label>
            <input id="new-property" type="text" class="form-control">
        </div>
        <button class="btn btn-primary" id="add-new-property" style="position: absolute; left: 0; top: 0;">
            <i class="material-icons">add</i>
        </button>
    </div>
</div>
<div class="row">
@foreach($properties as $property)
     <div class="col-12 col-sm-6 col-lg-4">
         <div class="property-item row">
             <div class="property-item-title col-6">{{ $property->title }}</div>
             <div class="property-item-actions col-6">
                 <button class="btn btn-success" onclick="updateProperty({{ $property->id }})">
                     <i class="material-icons">edit</i>
                 </button>
                 <button class="btn btn-danger" onclick="deleteProperty({{ $property->id }})">
                     <i class="material-icons">delete</i>
                 </button>
             </div>
         </div>
     </div>
@endforeach
</div>
<hr />
<div class="clearfix"></div>
