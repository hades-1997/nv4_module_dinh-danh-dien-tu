<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{FORM_ACTION}" method="post">
    <input name="save" type="hidden" value="1" />
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.donvi}</strong> <span class="red">(*)</span></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="donvi" value="{ROW.donvi}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dulieu_1}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="dulieu_1" value="{ROW.dulieu_1}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dulieu_2}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="dulieu_2" value="{ROW.dulieu_2}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dulieu_3}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="dulieu_3" value="{ROW.dulieu_3}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dulieu_4}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="dulieu_4" value="{ROW.dulieu_4}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dulieu_5}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="dulieu_5" value="{ROW.dulieu_5}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dulieu_6}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="dulieu_6" value="{ROW.dulieu_6}" />
        </div>
    </div>
    <div class="form-group" style="text-align: center">
        <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
    </div>
</form>
</div></div>
<!-- END: main -->