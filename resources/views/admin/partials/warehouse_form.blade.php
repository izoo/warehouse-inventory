<form id="formWarehouse" method="POST">

<div class="form-row mb-4">
<div class="form-group col-md-12 col-lg-12 col-sm-12">
<label class="control-label">Warehouse Code/Unique Number</label>
<input class="form-control input-lg" id="device_number" name="code" type="text">
<div class="input-group-append">
<a href="#" class="input-group-text" id="generate-number">Generate</a>
</div>
</div>
<div class="form-group col-md-6" style="display: none;">
<label for="product_quantity">Managed By</label>
<select name="user_id" id="user_id" class="form-control input-lg">
<option value="" disabled selected>--------</option>

</select>
</div>

</div>

<div class="form-row mb-4">
            
    <div class="form-group col-md-6 col-lg-6 col-sm-12">
        <label for="name">Warehouse Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Warehouse Name">
    </div>
        <div class="form-group col-md-6 col-lg-6 col-sm-12">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address">
        </div>

        
    </div> 

    <div class="form-row mb-4">
            
        <div class="form-group col-md-6 col-lg-6 col-sm-12">
            <label for="name">Warehouse Description</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        </div>

<div style="margin-left:40%;">
<button type="submit" id="buttonAddress" class="btn btn-primary mt-3 mx-5">ADD
</button>
</div>
</form>