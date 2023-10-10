function dltItem(id){
    if (window.confirm("Delete this product?")) {
        window.location.href=`../modules/delete_item.php?id=${id}`;
    }
}
