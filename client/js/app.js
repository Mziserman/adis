$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

var form = $('form[name="diplomaSearch"]');
form.find("a").click(function(e) {
  e.preventDefault();
  form.submit();
});

var submitForms = function() {
  postData = [];
  forms = $('form')
  forms.each(function(i, el) {
    var curr = {};
    if (i != 0) {
      curr["validated"] = $("#isValidated" + i).is(':checked');
      curr["role"] = $(el).find('select[name=role]').val()
      curr["user_id"] = $(el).find('input[type=hidden]').val()
      postData.push(curr)
    }
  })

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "/admin/update", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.send(JSON.stringify(postData));
  window.location.assign('/admin')
}