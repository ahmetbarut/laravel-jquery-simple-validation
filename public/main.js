function validateForm(selector, uri, method = "POST") {
    $(selector + " .form-control").removeClass("border");
    $(selector + " .form-control").parent().removeClass("border");
    $.ajax({
        method: method,
        url: uri,
        data: $(selector).serialize(),
        success: function() {
            $(selector).attr("method", method);
            $(selector).attr("action", uri);
            $(selector).submit();
        },
        error: function(xhr, status) {
            xhr.responseJSON.errors.map(function(error) {
                if ('contract1' == error.rule || 'contract2' == error.rule) {
                    $(selector + " .form-control[name=" + error.rule + "]").parent().addClass(['border-danger', 'border']);
                } else {
                    $(selector + " .form-control[name=" + error.rule + "]").addClass(['border-danger', 'border']);
                }
            });
        }
    });
}