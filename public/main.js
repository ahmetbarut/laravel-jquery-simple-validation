function validateForm(selector, uri, method = "POST", errorClass = ["border-danger border"]) {
    $(selector + " .form-control").removeClass(errorClass);
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
                $(selector + " .form-control[name=" + error.rule + "]").addClass(errorClass);
            });
        }
    });
}