 /*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/

$(document).ready(function(){
	
	
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

//Filter per kolom
    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
         /*$rows.show(); */
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
	document.getElementById("myBtn2Excel").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
	document.getElementById("myBtn2Excel").style.display = "none";
  }
}

//smooth scroll omhoog onder top knop
function scrolltop()
{
 $('html, body').animate({scrollTop : 0},1500);
}


  function ExportToExcel(type, fn, dl) {
			var today = new Date();
			var date = today.getFullYear()+"-"+('0'+(today.getMonth()+1)).slice(-2)+"-"+('0'+today.getDate()).slice(-2);
			var time = today.getHours() + "-" + today.getMinutes() + "-" + today.getSeconds();
            var elt = document.getElementById('myTable');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || (document.title +'_'+ date +'__'+ time +'.' + (type || 'xlsx')));
        }

//Quick search
function filterTable(event) {
    var filter = event.target.value.toUpperCase();
    var rows = document.querySelector("#myTable tbody").rows;
	var columns = document.getElementById('myTable').rows[0].cells;
    for (var i = 0; i < rows.length; i++) {
		for (var j = 0; j < columns.length; j++) {
			if ((rows[i].cells[j].textContent.toUpperCase().indexOf(filter) > -1) ) {
            rows[i].style.display = "";
			j=columns.length;
			} 
		else 
		{
            rows[i].style.display = "none";
			}      
		}
    }
}


// Reset Quick search
function remove(el) {
  var element = el;
  element.value='';
   var rows = document.querySelector("#myTable tbody").rows;
   for (var i = 0; i < rows.length; i++) {
      rows[i].style.display = "";
   }
}

/* Scroll + refresh test 
	$("html, body").animate({ scrollTop: $(document).height() }, 20000, function() {
		
  location.reload(true);
});
*/

/* Scroll + refresh test 
	 scrollToAnchor('scroll');
	
function scrollToAnchor(aid){
  const destination = $("a[name='"+ aid +"']");
    $('html,body').animate({
      scrollTop: destination.offset().top
    },40000,"linear",function(){ location.reload(true);
	});
}*/
