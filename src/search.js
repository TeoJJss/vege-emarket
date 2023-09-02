function searchFunction(type) {
    var inputElement, body;
    
    if (type == 'product') {
        inputElement = document.getElementsByClassName('product-content-search-input')[0];
        body = document.getElementsByClassName('product-table')[0];
    } else if (type == 'user') {
        inputElement = document.getElementsByClassName('user-content-search-input')[0];
        body = document.getElementsByClassName('user-table')[0];
    }else{
        inputElement = document.getElementsByClassName('search-input')[0];
        body = document.getElementsByClassName('table')[0];
    }
    
    var input = inputElement.value.toUpperCase();
    var rows = body.getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
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
