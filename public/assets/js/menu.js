let iconMenu = document.getElementById('iconMenu');
let sidebar = document.getElementById('sidebar');
let mainContent = document.getElementById('mainContent');

sidebar.style.left = '-200px';

let w = window.innerWidth;

window.addEventListener("resize", () => {
    w = window.innerWidth;
    if (w <= 768) {
        mainContent.style.width = '100%';
    } else {
    }
})

if (w <= 768) {
    sidebar.classList.add('hide');
} else {
    sidebar.classList.remove('hide');
}

function responseSidebar() {
    if (w <= 768) {
        if (sidebar.classList.contains('hide') || sidebar.style.left == '-200px') {
            sidebar.classList.remove('hide');
            sidebar.style.left = '0px'
        } else {
            sidebar.style.left = '-200px'
        }
    } else {
        if (sidebar.style.display == 'none') {
            sidebar.style.display = 'block';
            mainContent.style.width = 'calc(100% - 200px)';
        } else {
            sidebar.style.display = 'none';
            mainContent.style.width = '100%';
        }

    }
}

