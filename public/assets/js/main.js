

const toggleMenu = () => {
    var menu = document.getElementById("menu");
    menu.classList.toggle('hidden');
}

const loadMore = (event) => {
    document.getElementById("more_desc").classList.toggle('hidden');
    document.getElementById("more_dots").classList.toggle('hidden');
    
    let btn=event.target;
    (btn.textContent=='See less') ? btn.textContent='See more' : btn.textContent='See less'; 

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