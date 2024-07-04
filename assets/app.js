import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';


const pwd = document.getElementById('user_password');
const confirm = document.getElementById('user_password_Checker');

/* TEST pour toggle show hide mdp
let checkBox = document.getElementById('password_switch');

checkBox.addEventListener('click', function(e){
    if (checkBox.checked) {
        pwd.type = 'text';
        confirm.type = 'text';
    } else {
        pwd.type = 'password';
        confirm.type = 'password';
    }
}) */

/*confirm.addEventListener('change', function(){
    if(pwd.length !== 0 && confirm.length !== 0){} {
        if(pwd.value === confirm.value){
            alert('Les mots de passe correspondent.')
        } else {
            alert('Les mots de passe ne correspondent pas.')
        }
    }
})*/