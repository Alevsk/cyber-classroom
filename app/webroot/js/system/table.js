$(document).ready(function(){

  /* Reusable Javascript */

  $('.delete-records').click(function(){
    var answer = window.confirm("¿Esta seguro de eliminar los registros?");
    if(answer)
    {
      $("#TableRecordsForm").submit();
    }  
  })

  $('.select-records').click(function(){
      var checkboxes = $('#TableRecordsForm').find(':checkbox');
      checkboxes.prop('checked', true);
      $('.table_row').addClass('row_selected');
  })

  $('.unselect-records').click(function(){
    var checkboxes = $('#TableRecordsForm').find(':checkbox');
      checkboxes.prop('checked', false);
      $('.table_row').removeClass('row_selected');
  })

  $("#moreOptions").click(function() {
    $("#theOptions").toggle();
  });

  $('.tableCheckbox').change(function() {
          if($(this).is(":checked"))
          { 
            $(this).closest('tr').addClass('row_selected');
          }  
          else
          {
            $(this).closest('tr').removeClass('row_selected');
          }    
   });

});