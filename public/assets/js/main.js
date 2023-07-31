


const toggleMenu = () => {
    var menu = document.getElementById("menu");
    console.log(menu.parentElement);
    // menu.classList.toggle('hidden');
}

const showNotifications = () => {
    let notif = document.getElementById("notif");
    notif.classList.toggle('hidden');
}

const changeTab = (event) => {
    
    let selected = document.getElementById('selected');
    let activeStyles=["text-blue-600", "border-b-2", "border-blue-600"];
    
    selected.classList.remove(...activeStyles);
    console.log(selected.props);
    selected.id='';

    event.target.classList.add(...activeStyles);
    let a = event.target.classList.remove('hidden');
    event.target.id='selected';
    
}