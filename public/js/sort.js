var ascending = true; // Biến theo dõi trạng thái sắp xếp
    function sortTable(colIndex) {
    var table = $("#myTable");
    var rows = $("tr.info", table).toArray(); // Chuyển đổi thành một mảng để sử dụng trong jQuer
    
    ascending = !ascending
    
    rows.sort(function (a, b) {
      var x = $(a).find("td").eq(colIndex).text().toLowerCase();
      var y = $(b).find("td").eq(colIndex).text().toLowerCase();

      if (ascending) {
        return x.localeCompare(y);
      } else {
        return y.localeCompare(x);
      }
    });
    $.each(rows, function (index, row) {
      table.append(row);
    });
  }

