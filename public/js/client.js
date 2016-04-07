$(function() {

  var ele_del_client = $("a[id^='del_']");

  function delete_client(id) {
    $.ajax({
      url: '/client/' + id,
      type: 'DELETE',
      success: function(result) {
        if (result.error == false) {
            window.location.href = '/client';
            return true;
        }
        alert('删除失败，请检查后再试');
      }
    });
  }

  ele_del_client.each(function(i, e){
    var ele = $(e);
    ele.click(function(e){
      var ele = e.currentTarget
      var client_id = $(ele).attr('data-client-id');
      if (confirm('确信要删除此应用？')) {
        delete_client(client_id);
      }
    });
  });

});
