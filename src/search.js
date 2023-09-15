function searchFunction(type) {
    var inputElement, body;
    
    if (type == 'product') {
        inputElement = document.getElementById('product-content-search-input');
        body = document.getElementById('product-table');
    } else if (type == 'user') {
        inputElement = document.getElementById('user-content-search-input');
        body = document.getElementById('user-table');
    }else{
        inputElement = document.getElementById('search-input');
        body = document.getElementById('searchable-content');
    }
    
    var input = inputElement.value.toUpperCase();
    var rows = body.getElementsByClassName('searchable-row');
    
    for (let i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByClassName('search-key');
        let rowMatch = false;
        
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerHTML.toUpperCase().indexOf(input) > -1) {
                rowMatch = true;
                break;
            }
        }
        
        if (rowMatch) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
