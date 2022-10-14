<form method="POST" id="formRepair">
    <div id="repairError">

    </div>
    <div class="row mb-3">

        <div class="col-md-6 col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="control-label">Device * </label>
                <select name="repair_device" id="repair_device" class="form-control input-lg">
                    <option value="" disabled selected>.......</option>

                </select>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="control-label">Technician * </label>
                <select name="repair_technician" id="repair_technician" class="form-control input-lg">
                    <option value="" disabled selected>--------</option>

                </select>
            </div>
        </div>
    </div>
    <div class="row">

    </div>

    <div class="row mb-3">
        <div class="col-md-5 col-sm-5 col-lg-5">
            <div class="form-group">
                <label class="control-label">Spare Part</label>
                <select name="repair_spare[]" id="repair_spare" class="form-control input-lg repair_spare">
                    <option value="" disabled selected>--------</option>

                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="control-label">Spare Quantity</label>
                <input class="form-control input-lg" id="repair_quantity[]" name="repair_quantity[]" type="number">

            </div>
        </div>
        <div class="col-md-1 col-sm-1 col-lg-1" style="padding-top:30px;">
            <a href="#" id="addRow" onclick="" class="btn btn-success">+</a>
        </div>
    </div>
    <div id="newRow">

    </div>
    <div class="row mb-3">
        <div class="col-md-2 col-sm-2 col-lg-2">
            <div class="form-group">
                <label class="control-label"> Service</label>
                <select class="form-control input-lg service_name" name="service[]" id="repair_service">
                    <option disabled>Select Service</option>
                  
                </select>

            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="repair_issue">
                    Service Description
                </label>
                <textarea class="form-control" name="repair_issue[]" id="repair_issue" cols="30" rows="5">

                                        </textarea>
            </div>

        </div>
        <div class="col-md-2 col-sm-2 col-lg-2">
            <div class="form-group">
                <label class="control-label" style="font-size:12px;">Estimated Issue
                    Cost</label>
                <input class="form-control input-lg" id="estimated_cost" name="estimated_cost[]" type="number">

            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-2">
            <div class="form-group">
                <label class="control-label" style="font-size:10px;">Estimated
                    Completion Duration</label>
                <input class="form-control input-lg" id="duration" name="duration[]" type="number">

            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-2">
            <div class="form-group">
                <label class="control-label"> Duration In</label>
                <select class="form-control input-lg" name="duration_in[]" id="duration_in">
                    <option value="hrs">hrs</option>
                    <option value="days">days</option>
                    <option value="weeks">weeks</option>
                    <option value="months">months</option>
                </select>

            </div>
        </div>
        <div class="col-md-1 col-sm-1 col-lg-1" style="padding-top:30px;">
            <a href="#" id="addRow2" class="btn btn-success">+</a>
        </div>
    </div>
    <div id="newRow2">

    </div>

    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="tile-footer">
                <button class="btn btn-primary" id="buttonRepair" type="submit"
                    style="margin-left:20%;margin-right:50%;">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>ADD</button>&nbsp;&nbsp;&nbsp;<a
                    class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>RESET</a>
            </div>
        </div>
    </div>

</form>