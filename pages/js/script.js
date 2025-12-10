function show_form_add_user() {
    const form = document.getElementById('add_user_form');
    form.style.display = 'flex';
}
function hidde_form_add_user() {
    const form = document.getElementById('add_user_form');
    form.style.display = 'none';

}


function location_vers_gestion_utilisateur(){
    window.location.href("../admin_pages/gestion_utilisateur.php");
}


function location_vers_gestion_produit(){
    window.location.href("../admin_pages/gestion_produit.php");
}