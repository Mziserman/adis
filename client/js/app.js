$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

var form = $('form[name="diplomaSearch"]');
form.find("a").click(function(e) {
  e.preventDefault();
  form.submit();
});

var submitForms = function() {
  for (var i = 0; i < document.forms.length; i++) {
    document.forms[i].submit();
  }
}