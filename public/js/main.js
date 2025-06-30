
/**
 * listen on click and post data-id field to data-url
 */
$(function () {
    $('.post-link-clickable').on('click', function () {
        fnc.postFormWithIdFieldToUrl($(this).data('url'), $(this).data('id'));
    });
});

/**
 * post to url with given fields in json format
 *
 * @param url
 * @param array fields
 */
fnc.postFormWithFieldsToUrl = function (url, fields) {

    var form = this.createForm(url);
    this.addHiddenInputFields(form, fields);
    document.body.appendChild(form);
    form.submit();
};

/**
 * post to url with given id form field
 *
 * @param url
 * @param id
 */
fnc.postFormWithIdFieldToUrl = function (url, id) {
    var form = this.createForm(url);
    this.addHiddenInputField(form, 'id', id);
    this.addCsrfTokenField(form);
    document.body.appendChild(form);
    form.submit();
};

/**
 * create html post form
 *
 * @param url
 * @returns {HTMLFormElement}
 */
fnc.createForm = function (url) {
    var formName = 'form';
    var form = document.createElement(formName);
    form.setAttribute("method", "post");
    form.setAttribute("action", url);
    return form;
};

/**
 * helper function for adding input fields to html form
 *
 * @param form
 * @param fields
 */
fnc.addHiddenInputFields = function (form, fields) {

    var keys = Object.keys(fields);
    for (var i = 0; i < keys.length; i++) {
        var key = keys[i];
        this.addHiddenInputField(form, key, fields[key]);
    }
};

/**
 * helper function to add a single input field to a html form
 *
 * @param form
 * @param name
 * @param value
 */
fnc.addHiddenInputField = function (form, name, value) {
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", name);
    hiddenField.setAttribute("value", value);
    form.appendChild(hiddenField);
};
