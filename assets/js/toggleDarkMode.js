const toggleBtn = document.getElementById('toggleDarkModeBtn');
const toggleText = document.getElementById('toggleDarkModeText');
const html = document.documentElement;
console.log('hello');

toggleBtn.addEventListener('click', function() {
    console.log('click');
    html.classList.toggle('dark');
});