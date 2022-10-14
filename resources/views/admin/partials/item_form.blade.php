<form class="form-horizontal" id="formProduct" enctype="multipart/form-data" method="post">
    <div id="userErrors" class="alert alert-danger print-error-msg w3-padding-right w3-padding-left"
        style="display:none;">
        <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
        <ul class="w3-ul" style="list-style:none;">

        </ul>
    </div>
    <div class="row mb-3">

        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <label class=" control-label">Item Name</label>
            <div class="">
                <input type="text" name="item_name" id="item_name" class="form-control input-lg"
                    placeholder="Item Name">
            </div>
        </div>

    </div>
    <div class="form-row mb-4">
        <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6">
            <label class="control-label">Category</label>
            <select name="category_id" id="category_id" class="form-control input-lg">
                <option value="" disabled selected>.......</option>


            </select>

        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6">
            <label class="control-label">Brand</label>
            <select name="brand_id" id="brand_id" class="form-control input-lg">
                <option value="" disabled selected>.......</option>


            </select>
        </div>

    </div>
    <div class="row mb-3">


        <div class="form-group col-md-12  col-lg-12  col-sm-12">
            <label class="control-label">Product Description/Specifications</label>
            <textarea name="description" id="description" class="description form-control" cols="30"
                rows="6"></textarea>

        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6">
            <label class="control-label">Unit</label>
            <select name="unit" id="unit" class="form-control input-lg">
                <option value="" disabled selected>.......</option>
                <option value="Pieces">Pieces</option>
                <option value="Kilograms">Kgs</option>
                <option value="meters">Meters</option>


            </select>
        </div>
    </div>
    </div>

    

    <div style="margin-left: 50%;">
        <button type="submit" id="buttonProduct" class="btn btn-primary hvr-icon-float-away col-24">SAVE</button>
    </div>
</form>