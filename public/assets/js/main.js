
const toggleMenu = () => {
    var menu = document.getElementById("menu");
    menu.classList.toggle('hidden');
}

const changeTab = (event) => {
    
    let selected = document.getElementById('selected');
    let activeStyles=["text-blue-600", "border-b-2", "border-blue-600"];
    
    selected.classList.add('hidden');
    selected.classList.remove(...activeStyles);
    selected.id='';

    event.target.classList.add(...activeStyles);
    let a = event.target.classList.remove('hidden');
    event.target.id='selected';
    
    console.log(a);
}