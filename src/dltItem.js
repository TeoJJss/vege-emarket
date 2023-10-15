function dltItem(id){
    if (window.confirm("Delete this product? This action is irreversible!")) {
        window.location.href=`../modules/delete_item.php?id=${id}`;
    }
}
