
// $(document).ready(function () {
//     $('.selectable-row').click(function () {

//       $(this).toggleClass('selected');
//       var selectedRowId = $(this).data('id');

//       $('#udQtyModal').modal('show');

//       $('#transactionNo').val(selectedRowId);
//     //   console.log('Selected Row ID:', selectedRowId);
//     });
//   });
 
    $(document).keydown(function (e) {
      console.log('Uel;loo')
      var selectedRowIndex = -1;
      $('.selectable-row').click(function () {
          $('.selectable-row').removeClass('selected');
          $(this).addClass('selected');
          selectedRowIndex = $(this).hasClass('selected') ? $(this).index() : -1;
          // Scroll to the selected row
          scrollToSelectedRow();
        
        });
      if (e.which === 38 || e.which === 40) {
        e.preventDefault(); 
        var rows = $('.selectable-row');
        rows.removeClass('selected');
        // Update the selectedRowIndex based on the arrow key
        if (e.key === 'ArrowUp' && selectedRowIndex > 0) {
          selectedRowIndex--;
         
        } else if (e.which === 40 && selectedRowIndex < rows.length - 1) {
          selectedRowIndex++;
        }
        // Add the 'selected' class to the row at the updated selectedRowIndex
        rows.eq(selectedRowIndex).addClass('selected');
    
        // Scroll to the selected row
        scrollToSelectedRow();
      }
    });
  
    function scrollToSelectedRow() {
      var container = $('.pos-transaction');
      
      var selectedRow = $('.selectable-row.selected');
    
      container.scrollTop(selectedRow.offset().top - container.offset().top + container.scrollTop());
    }
  
      // Select the last row on page load
      var lastRow = $('.selectable-row:last');
      lastRow.addClass('selected');
      selectedRowIndex = lastRow.index();
  
      // Scroll to the selected row on page load
      scrollToSelectedRow();

