<form id="formCharge" method="POST">
    <div class="form-row mb-4">
        <div class="form-group col-md-6">
            <label class="control-label">Unit</label>
            <select name="unit" id="unit" class="form-control input-lg">
                <option value="" disabled selected>--------</option>
                <option value="Pieces">Pieces</option>
                <option value="Kgs">Kgs</option>
                <option value="Grams">Grams</option>
                <option value="Meters">Meters</option>
                <option value="Sacks">Sacks</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label">Select Plan</label>
            <select name="charge_plan" id="charge_plan" class="form-control input-lg">
                <option value="" disabled selected>.......</option>
                <option value="hour">Per Hour</option>
                <option value="day">Per Day</option>
                <option value="week">Per Week</option>
                <option value="month">Per Month</option>
                
            </select>
        </div>

    </div>
    <div class="form-row mb-4">
        <div class="form-group col-md-12 col-lg-12 col-sm-12">
            <label class="control-label">Cost/Charge</label>
            <input class="form-control input-lg" id="cost_charge" name="cost_charge" type="text">
            
        </div>
        

    </div>

    <!-- <div class="form-row mb-4">
                                         
                                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                        <label for="product_desc">Product Description</label>
                                        <input type="text" class="form-control" name="product_desc" id="product_desc" placeholder="Product Description">
                                    </div>
                                        <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                            <label for="product_photo">Product Photo</label>
                                            <input type="file" class="form-control" name="product_photo" id="product_photo">
                                        </div>
                   
                                        
                                    </div> -->

    <div style="margin-left:40%;">
        <button type="submit" id="buttonCharge" class="btn btn-primary mt-3 mx-5">ADD
            CHARGE</button>
    </div>
</form>