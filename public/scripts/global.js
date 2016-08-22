jQuery(document).ready(function($) {

    var loader = $("#stLoader"),
            response = $("#filterAjaxResponse");

    /*
     * Datepicker
     */
    $(".isDatepicker").datepicker({
        dateFormat: "dd-mm-yy"
    });

    /*
     * Numeric fields
     */
    $(document).on("keyup blur", ".isNum", function() {
        var v = $(this).val();
        if (isNaN(v)) {
            $(this).val("");
        }
    });

    /*
     * DEALS SEARCH
     */
    $(document).on("keyup blur", "input#dealsSearch", function(){
        var searchTerm = $(this).val();
        ajaxReqData.search = searchTerm;
    });

    /*
     * PRICE PRODUCT SORTING
     */
    $(document).on("click", "#filterAjaxBtn", function() {
        var _this = $(this);

        ajaxReqData.action = "sorting";
        ajaxReqData.range = priceRange.values;
        ajaxReqData.sort = $("select.sortBy option:selected").val();

        $.ajax({
            type: "POST",
            url: site_url + "ajax",
            dataType: "json",
            data: ajaxReqData,
            beforeSend: function() {
                loader.show();
            },
            error: function() {
                loader.hide();
            },
            success: function(r) {
                response.html(r.data);
                loader.hide();
            }
        });
    });

    /*
     * PRODUCT SORTING
     */
    $(document).on("change", "select.sortBy", function() {
        var _this = $(this), sortType = ("option:selected", _this).val();

        if (sortType == "" || sortType == null) {
            return false;
        }

        ajaxReqData.action = "sorting";
        ajaxReqData.range = priceRange.values;
        ajaxReqData.sort = sortType;

        $.ajax({
            type: "POST",
            url: site_url + "ajax",
            dataType: "json",
            data: ajaxReqData,
            beforeSend: function() {
                loader.show();
            },
            error: function() {
                loader.hide();
            },
            success: function(r) {
                response.html(r.data);
                loader.hide();
            }
        });
    });


    /*
     * FILTER Campaign
     * 
     */
    $(document).on("click", "button#stCampaignFilter", function() {
        $("input[name='rangeMin']").val(priceRange.values[0]);
        $("input[name='rangeMax']").val(priceRange.values[1]);
        $("form#stCampaignFilterForm").submit();
    });


    /*
     * CHANGE PASSWORD
     * 
     */
    $(document).on("submit", "form#stChangePassForm", function(e) {
        e.preventDefault();

        var _this = $(this), _formData = _this.serializeArray();

        _formData.push({name: "action", value: "changepass"});

        $.ajax({
            type: "POST",
            url: site_url + "ajax",
            dataType: "json",
            data: _formData,
            beforeSend: function() {
                $(".alert", _this).hide();
                loader.show();
            },
            error: function() {
                loader.hide();
            },
            success: function(r) {
                if (r.res) {
                    $(".alert", _this).removeClass("alert-danger").addClass("alert-success").text(r.msg).show();
                    _this[0].reset();

                    setTimeout(function() {
                        $("button#stChangePassCnl").click();
                        $(".alert", _this).hide();
                    }, 3000);
                } else {
                    $(".alert", _this).removeClass("alert-success").addClass("alert-danger").text(r.msg).show();
                }
                loader.hide();
            }
        });
    });


    /*
     * CHANGE PREFERENCES
     * 
     */
    $(document).on("submit", "form#stPreferenceForm", function(e) {
        e.preventDefault();

        var _this = $(this), _formData = _this.serializeArray();

        _formData.push({name: "action", value: "preference"});

        $.ajax({
            type: "POST",
            url: site_url + "ajax",
            dataType: "json",
            data: _formData,
            beforeSend: function() {
                $(".alert", _this).hide();
                loader.show();
            },
            error: function() {
                loader.hide();
            },
            success: function(r) {
                if (r.res) {
                    $(".alert", _this).removeClass("alert-danger").addClass("alert-success").text(r.msg).show();
                    window.location.reload();
                } else {
                    $(".alert", _this).removeClass("alert-success").addClass("alert-danger").text(r.msg).show();
                }
                loader.hide();
            }
        });
    });
    
});