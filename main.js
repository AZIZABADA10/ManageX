function changer_form(id_form){
    document.querySelectorAll('.form_info').forEach(form => form.classList.remove('active'));
    document.getElementById(id_form).classList.add('active');
}


